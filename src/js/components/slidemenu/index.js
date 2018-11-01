var Utils = require('../../components/utils/index.js');
var Slideout = require('slideout');

var slideMenu = {


    init: function()
    {
        this.activateSlidemenu();
    },


    activateSlidemenu: function()
    {
        var slideout = new Slideout({
            'panel': document.getElementById('app'),
            'menu': document.getElementById('menu'),
            'padding': 256,
            'tolerance': 70,
            'easing': 'cubic-bezier(.32,2,.55,.27)',
            'side': 'right'
        });
        
        document.querySelector('.toggle-button').addEventListener('click', function() {
            slideout.toggle();
        });
    },

}


module.exports = slideMenu;

