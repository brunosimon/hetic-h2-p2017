var Game = function(){};

Game.prototype =
{
    init: function()
    {
        console.log('init game');

        this.pet = new Pet();
        this.pet.init();

        this.init_events();
    },

    init_events: function()
    {
        this.buttons       = {};
        this.buttons.feed  = document.getElementById('feed');
        this.buttons.slap  = document.getElementById('slap');
        this.buttons.sleep = document.getElementById('sleep');
        this.buttons.hug   = document.getElementById('hug');

        var that = this;

        this.buttons.feed.onclick = function()
        {
            that.pet.feed();
            return false;
        };

        this.buttons.slap.onclick = function()
        {
            that.pet.slap();
            return false;
        };

        this.buttons.sleep.onclick = function()
        {
            that.pet.sleep();
            return false;
        };

        this.buttons.hug.onclick = function()
        {
            that.pet.hug();
            return false;
        };
    }
};