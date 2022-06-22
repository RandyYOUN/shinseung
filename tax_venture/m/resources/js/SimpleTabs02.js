var TabBlock = {
    s: {
        animLen: 0
    },

    init: function () {
        TabBlock.bindUIActions();
        TabBlock.hideInactive();
    },

    bindUIActions: function () {
        $('.tabtop').on('click', '.tabmenu', function () {
            TabBlock.switchTab($(this));
            $('.subtabsWrap').find('.swiper-container')[0].swiper.update();
        });
    },

    hideInactive: function () {
        var $tabBlocks = $('.subtabsWrap');

        $tabBlocks.each(function (i) {
            var
                $tabBlock = $($tabBlocks[i]),
                $panes = $tabBlock.find('.subtabarea'),
                $activeTab = $tabBlock.find('.tabmenu.active');

            $panes.hide();
            $($panes[$activeTab.index()]).show();
        });
    },

    switchTab: function ($tab) {
        var $context = $tab.closest('.subtabsWrap');

        if (!$tab.hasClass('active')) {
            $tab.siblings().removeClass('active');
            $tab.addClass('active');

            TabBlock.showPane($tab.index(), $context);
        }
    },

    showPane: function (i, $context) {
        var $panes = $context.find('.subtabarea');

        // Normally I'd frown at using jQuery over CSS animations, but we can't transition between unspecified variable heights, right? If you know a better way, I'd love a read it in the comments or on Twitter @johndjameson
        $panes.slideUp(TabBlock.s.animLen);
        $($panes[i]).slideDown(TabBlock.s.animLen);
    }
};

$(function () {
    TabBlock.init();
});
