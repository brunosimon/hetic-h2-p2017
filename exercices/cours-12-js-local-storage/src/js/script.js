var Pet = function(){};

Pet.prototype =
{
    /**
     * INITIALISE
     */
    init : function()
    {
        this.retrieve_from_local_storage();
        this.display_info();
    },

    /**
     * GIVE A HUG
     * Increase hapiness
     */
    hug : function()
    {
        this.hapiness += 5;
        this.display_info();
        this.save();
    },

    /**
     * FEED
     * Lower hungriness
     */
    feed : function()
    {
        this.hungriness -= 5;
        this.display_info();
        this.save();
    },

    /**
     * GIVE A SLAP
     * Lower hapiness
     */
    slap : function()
    {
        this.hapiness -= 10;
        this.display_info();
        this.save();
    },

    /**
     * DISPLAY INFORMATIONS
     * Log informations
     */
    display_info: function()
    {
        console.log('---- INFOS ---------------------------------------------');
        console.log('hapiness : ' + this.hapiness);
        console.log('hungriness : ' + this.hungriness);
        console.log('color : ' + this.color);
    },

    /**
     * RETRIEVE FROM LOCAL Storage
     * If no data in local storage, create them
     */
    retrieve_from_local_storage: function()
    {
        //Save found
        if(localStorage.save)
        {
            //Get save and add data to 'this'
            var save        = JSON.parse(localStorage.save);
            this.hapiness   = save.hapiness;
            this.hungriness = save.hungriness;
            this.color      = save.color;
        }

        //No save found
        else
        {
            //Create data
            this.hapiness   = 50;
            this.hungriness = 0;
            this.color      = 'red';
        }
    },

    /**
     * SAVE
     */
    save: function()
    {
        localStorage.save = JSON.stringify(this);
    }
};

var my_pet = new Pet();
my_pet.init();