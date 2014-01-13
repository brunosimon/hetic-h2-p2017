<?php 

    if(!empty($_POST))
    {
        $data   = sanetize($_POST);
        $errors = check($data);
    }

    else
    {
        $data = array(
            'first_name' => '',
            'last_name'  => '',
            'age'        => 23,
            'gender'     => 'mrs'
        );
    }

    function sanetize($data = array())
    {
        $data['first_name'] = strip_tags(trim($data['first_name']));
        $data['last_name']  = strip_tags(trim($data['last_name']));
        $data['gender']     = strip_tags(trim($data['gender']));
        $data['age']        = (int)$data['age'];

        return $data;
    }

    function check($data = array())
    {
        $errors = array();

        // First name
        if(empty($data['first_name']))
            $errors['first_name'] = 'First name cannot be empty';

        // Last name
        if(empty($data['last_name']))
            $errors['last_name'] = 'Last name cannot be empty';

        // Age
        if(empty($data['age']) || $data['age'] < 18 || $data['age'] > 120)
            $errors['age'] = 'Wrong age';        

        return $errors;
    }

?>

<div class="errors">
    <?php foreach($errors as $_error): ?>
        <p><?php echo $_error; ?></p>
    <?php endforeach; ?>
</div>

<form action="#" method="post">
    <fieldset>
        <legend>Profile</legend>
        <div>
            <label for="first-name"></label>
            <input id="first-name" type="text" name="first_name" placeholder="First Name" value="<?php echo $data['first_name'] ?>">
        </div>
        <div>
            <label for="last-name"></label>
            <input id="last-name" type="text" name="last_name" placeholder="Last Name" value="<?php echo $data['last_name'] ?>">
        </div>
        <div>
            <label for="age"></label>
            <input id="age" type="number" name="age" min="18" max="110" value="<?php echo $data['age'] ?>">
        </div>
        <div>
            <label for="gender"></label>
            <select name="gender" id="gender">
                <option value="mr" <?php echo $data['gender'] == 'mr' ? 'selected="selected"' : '' ?>>Mr</option>
                <option value="mrs" <?php echo $data['gender'] == 'mrs' ? 'selected="selected"' : '' ?>>Mrs</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Send">
        </div>
    </fieldset>
</form>