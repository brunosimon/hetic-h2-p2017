<?php



	use Symfony\Component\HttpFoundation\Response;
	require_once 'config.php';
	require_once __DIR__.'/../vendor/autoload.php';

	$app = new Silex\Application();
	$app['debug'] = true;

	// Twig
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
		'twig.path' => __DIR__.'/views',
	));
	$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
	$app->register(new Silex\Provider\SessionServiceProvider());
	use Symfony\Component\HttpFoundation\Request;

	//Form Service
	use Silex\Provider\FormServiceProvider;

	$app->register(new FormServiceProvider());

	$app->register(new Silex\Provider\ValidatorServiceProvider());
	$app->register(new Silex\Provider\TranslationServiceProvider(), array(
	    'translator.domains' => array(),
	));



	// Home
	$app->get('/',function() use ($app, $snippets_model)
	{

		$snippets_model->update_count();

		// Prepare data
		$data = array(
			'title'    => 'Home',
			'snippets' => $snippets_model->get(),
			'categories' => $snippets_model->get_categories()
		);
		return $app['twig']->render('home.twig',$data);
	})
	->bind('home');

	// Categories
	$app->get('category/{category}/{page}',function($category, $page) use ($app, $snippets_model)
	{
		$snippets_model->update_count();

		// Prepare data
		$data = array(
			'title'    => 'Category : '.$category,
			'category' => $category,
			'pages'    => $snippets_model->get_pages($page,5,$category),
			'page'     => $page,
			'snippets' => $snippets_model->get_by_category_slug($category,5,$page),
			'categories' => $snippets_model->get_categories()
		);
		return $app['twig']->render('category.twig',$data);
	})
	->assert('category','[a-z0-9-]+') // Slug
	->assert('page','\d+') // Number
	->bind('category');

	$app->get('snippet/{id}',function($id) use ($app, $snippets_model)
	{
		$data = array(
			'title' => 'Sign in',
			'snippet' => $snippets_model->get_by_id($id),
			'categories' => $snippets_model->get_categories()
		);

		return $app['twig']->render('snippet.twig',$data);
	})
	->bind('snippet');

	$app->get('sign-in',function() use ($app, $snippets_model)
	{
		$data = array(
			'title' => 'Sign in',
			'categories' => $snippets_model->get_categories()
		);
		return $app['twig']->render('signin.twig',$data);
	})
	->bind('sign-in');

	$app->get('connect',function() use ($app, $snippets_model)
	{
		$data = array(
			'title' => 'Sign in',
			'categories' => $snippets_model->get_categories()
		);
		return $app['twig']->render('connect.twig',$data);
	})
	->bind('connect');

	$app->post('sign-in',function() use ($app, $snippets_model, $user_model)
	{

		if(isset($_POST)){
			if($_POST['password'] == $_POST['password2']){
				$user_model->new_user($_POST['name'], $_POST['password']);
			}
		}

		$data = array(
			'title' => 'Sign in',
			'categories' => $snippets_model->get_categories()
		);
		return $app['twig']->render('home.twig',$data);
	});

	$app->post('connect',function() use ($app, $snippets_model, $user_model)
	{

		if(isset($_POST)){
			$user_model->connect_user($_POST['name'], $_POST['password'],$app);
		}
		return $app->redirect($app['url_generator']->generate('home'));
	});

	$app->get('new-snippet',function() use ($app, $snippets_model)
	{
		$data = array(
			'title' => 'New snippet',
			'categories' => $snippets_model->get_categories()
		);
		return $app['twig']->render('new-snippet.twig',$data);
	})
	->bind('new-snippet');

	$app->post('new-snippet',function() use ($app, $snippets_model, $zip)
	{

		if(isset($_POST)){
			$snippets_model->new_snippet($_POST['title'], $_POST['category'], $_POST['content'], $app['session']->get('id'));

			$name = str_replace(' ','',$_POST['title']);
			$ourFileName = 'snippets/'.$name.".sublime-snippet";
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			fwrite($ourFileHandle, '<snippet>
					<content><![CDATA[
				'.$_POST['content'].'
				]]></content>
					<!-- Optional: Set a tabTrigger to define how to trigger the snippet -->
					<tabTrigger>'.$name.'</tabTrigger>
					<!-- Optional: Set a scope to limit where the snippet will trigger -->
					<!-- <scope>source.python</scope> -->
				</snippet>
			');
			fclose($ourFileHandle);


			$zip->open('snippets/'.$name.'.zip',ZipArchive::CREATE);
			$zip->addFile('snippets/'.$name.".sublime-snippet");
			$zip->close();
		}

		return $app->redirect($app['url_generator']->generate('home'));
	});


	$app->get('/logout',function() use ($app, $snippets_model, $user_model)
	{
		$data = array(
			'title' => $code,
			'categories' => $snippets_model->get_categories()
		);
		$app['session']->set('Connected', false);
		return $app->redirect($app['url_generator']->generate('home'));
	})
	->bind('logout');

	$app->get('/about',function() use ($app, $snippets_model)
	{
		$data = array(
			'title' => 'About',
			'categories' => $snippets_model->get_categories()
		);
		return $app['twig']->render('about.twig',$data);
	})
	->bind('about');

	$app->get('/account',function() use ($app, $snippets_model, $user_model)
	{
		$data = array(
			'title' => 'Account',
			'categories' => $snippets_model->get_categories(),
			'snippets'	=> $user_model->get_own_snippets($app['session']->get('id'))
		);
		return $app['twig']->render('account.twig',$data);
	})
	->bind('account');


	// Errors
	$app->error(function (\Exception $e, $code) use ($app, $snippets_model)
	{

		$data = array(
			'title' => $code,
			'categories' => $snippets_model->get_categories()
		);
		if($code == 404)
			return $app['twig']->render('404.twig',$data);
	});

	//Contact
	$app->match('/contact', function (Request $request) use ($app, $snippets_model)
	{
	    $formdata = array(
	        'name'     => 'Votre nom',
	        'email'   => 'Votre email',
	        'subject'   => 'Sujet du message',
	        'message' => 'Votre message'
	    );

	    $form = $app['form.factory']->createBuilder('form', $formdata)
	        ->add('name')
	        ->add('email')
	        ->add('subject')
	        ->add('message', 'textarea')
	        ->getForm();

	     $form->handleRequest($request);

	    if ($form->isValid()) {
	        $formdata = $form->getData();

	        $contactEmail = 'matthieu.lachassagne@yahoo.fr';
	        $headers = 'From: ' . $contactEmail . "\r\n" .
	          'Reply-To: ' . $formdata['email'] . "\r\n" .
	          'X-Mailer: PHP/' . phpversion();

	        $message = sprintf('Richard,\r\n.
	            You were sent a message using the contact form on your website.\r\n
	            Message: %s.\r\n
	            It was sent from %s who can be contacted at %s.',
	          $formdata['message'], $formdata['name'], $formdata['email']);

	      if (mail($contactEmail, 'Contact Form', $formdata['message'], $headers))
	      {
	        echo "1";
	      }
	      else {
	        echo "2";
	      }
	    }

	    $data = array(
	        'title'   => 'Contact',
	        'form' => $form->createView(),
	        'categories' => $snippets_model->get_categories()
	    );

	        // display the form
	    return $app['twig']->render('contact.twig',$data);
	})
	->bind('contact');

	$app->get('/delete/{id}',function($id) use ($app, $snippets_model)
	{
		$data = array(
	        'title'   => 'Home',
	        'categories' => $snippets_model->get_categories()
	    );

		$snippets_model->delete_snippet($id, $app['session']->get('id'));
		return $app['twig']->render('home.twig',$data);
	})
	->bind('delete');

	$app->get('/edit/{id}',function($id) use ($app, $snippets_model)
	{
		$data = array(
	        'title'   => 'Home',
	        'categories' => $snippets_model->get_categories(),
	        'snippet'   => $snippets_model->get_by_id($id)
	    );
		return $app['twig']->render('edit.twig',$data);
	})
	->bind('edit');

	$app->POST('/edit/{id}',function($id) use ($app, $snippets_model)
	{
		$snippets_model->update_snippet($_POST['title'], $_POST['category'], $_POST['content']);
		return $app->redirect($app['url_generator']->generate('home'));
	});

	$app->run();

?>
