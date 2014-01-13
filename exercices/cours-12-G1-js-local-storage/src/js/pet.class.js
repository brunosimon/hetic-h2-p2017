var Pet = function(){};

Pet.prototype =
{
    init: function()
    {
        console.log('init pet');

        this.create();

        this.show_infos();
    },

    create: function()
    {
        // Save exist
        if(localStorage.pet)
        {
            var options    = JSON.parse(localStorage.pet);

            this.health    = options.health;
            this.happiness = options.happiness;
            this.hunger    = options.hunger;
        }

        // No save
        else
        {
            this.health    = 0.5;
            this.happiness = 0.5;
            this.hunger    = 0.5;
        
            this.save();
        }

    },

    save: function()
    {
        localStorage.pet = JSON.stringify(this);
    },

    eat: function()
    {
        this.health += 0.05;
        this.hunger += 0.05;

        this.show_infos();
        this.save();
    },

    sleep: function()
    {
        this.health += 0.05;
        this.hunger -= 0.05;

        this.show_infos();
        this.save();
    },

    play: function()
    {
        this.happiness += 0.05;
        this.hunger    -= 0.05;

        this.show_infos();
        this.save();
    },

    slap: function()
    {
        this.health    -= 0.05;
        this.happiness -= 0.05;

        this.show_infos();
        this.save();
    },

    show_infos: function()
    {
        console.log('------------------------------');
        console.log('health : ' + this.health);
        console.log('happiness : ' + this.happiness);
        console.log('hunger : ' + this.hunger);
    }
};













