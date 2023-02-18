/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var smLib = smLib || {};

(function () {
    'use strict';

    smLib.Accordion = {};

    smLib.FileLoad = {};

    smLib.FileTransfer = {};

    smLib.ImageCut = {};

    smLib.ModalShow = {};

    smLib.MultiCheck = {};

    smLib.Paginator = {};

    smLib.SelectOption = {};

    smLib.ShoppingCart = {};

    smLib.SlideCarousel = {
        init: function (tgtID, options) {
            this.prototype = new SlideCarousel(tgtID, options);
        }, next: function () {
            this.prototype.next();
        }, prev: function () {
            this.prototype.prev();
        }, get: function () {
            this.prototype.get();
        }
    };

    smLib.TabPaginator = {};

}());
