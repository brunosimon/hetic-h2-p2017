var Game = function(){};

Game.prototype =
{
    init : function()
    {
        console.log('init game');

        this.init_event();

        this.pet = new Pet();
        this.pet.init();
    },

    init_event: function()
    {
        this.buttons       = {};
        this.buttons.eat   = document.getElementById('eat');
        this.buttons.sleep = document.getElementById('sleep');
        this.buttons.play  = document.getElementById('play');
        this.buttons.slap  = document.getElementById('slap');

        var that = this;

        this.buttons.eat.onclick = function()
        {
            that.pet.eat();
        };

        this.buttons.play.onclick = function()
        {
            that.pet.play();
        };

        this.buttons.sleep.onclick = function()
        {
            that.pet.sleep();
        };

        this.buttons.slap.onclick = function()
        {
            that.pet.slap();
        };
    }
};













