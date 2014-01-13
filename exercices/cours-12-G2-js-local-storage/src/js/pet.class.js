var Pet = function(){};

Pet.prototype =
{
    init: function()
    {
        console.log('init pet');

        this.create();
        this.display_infos();
    },

    save: function()
    {
        console.log('save');

        localStorage.pet = JSON.stringify(this);
    },

    create: function()
    {
        // Save exist
        if(localStorage.pet)
        {
            var properties = JSON.parse(localStorage.pet);

            this.happiness = properties.happiness;
            this.health    = properties.health;
            this.hunger    = properties.hunger;
        }

        // No save
        else
        {
            this.happiness = 50;
            this.health    = 50;
            this.hunger    = 50;

            this.save();
        }
    },

    slap: function()
    {
        this.happiness -= 8;
        this.health    -= 2;
        this.save();
        this.display_infos();
    },

    feed: function()
    {
        this.health += 2;
        this.hunger -= 10;
        this.save();
        this.display_infos();
    },

    hug: function()
    {
        this.happiness += 10;
        this.save();
        this.display_infos();
    },

    sleep: function()
    {
        this.health += 20;
        this.save();
        this.display_infos();
    },

    display_infos: function()
    {
        console.log('-------------------------');
        console.log('happiness : ' + this.happiness);
        console.log('health : ' + this.health);
        console.log('hunger : ' + this.hunger);
    }
};