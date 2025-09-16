jQuery(document).ready(function($) {
    const $siteNavigation = $('#site-navigation');
    const $menuButton = $siteNavigation.find('button').first();
    const $menu = $siteNavigation.find('ul').first();
    
    if (!$siteNavigation.length || !$menuButton.length || !$menu.length) {
        return;
    }
    
    if (!$menu.hasClass('nav-menu')) {
        $menu.addClass('nav-menu');
    }
    
    function isMobile() {
        return $(window).width() <= 568;
    }
    
    function resetNavigation() {
        if (!isMobile()) {
            $menu.removeAttr('style').show(); // Zobrazit menu na desktopu
            $menuButton.attr('aria-expanded', 'false');
            $siteNavigation.removeClass('toggled');
        }
    }
    
    function closeMenu() {
        if (isMobile()) {
            $menu.fadeOut(300);
            $menuButton.attr('aria-expanded', 'false');
            $siteNavigation.removeClass('toggled');
        }
    }
    
    function openMenu() {
        if (isMobile()) {
            $menu.fadeIn(300);
            $menuButton.attr('aria-expanded', 'true');
            $siteNavigation.addClass('toggled');
        }
    }
    
    // Click on menu button
    $menuButton.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if (!isMobile()) return;
        
        if ($menuButton.attr('aria-expanded') === 'true') {
            closeMenu();
        } else {
            openMenu();
        }
    });
    
    // Click on document
    $(document).on('click', function(e) {
        if (!isMobile()) return;
        
        if (!$siteNavigation.is(e.target) && 
            !$siteNavigation.has(e.target).length && 
            $menuButton.attr('aria-expanded') === 'true') {
            closeMenu();
        }
    });
    
    $siteNavigation.on('click', function(e) {
        if (isMobile()) {
            e.stopPropagation();
        }
    });
    
    $(window).on('resize', function() {
        clearTimeout(window.resizeTimer);
        window.resizeTimer = setTimeout(function() {
            resetNavigation();
        }, 250);
    });
    
    $(document).on('keydown', function(e) {
        if (e.keyCode === 27 && isMobile() && $menuButton.attr('aria-expanded') === 'true') {
            closeMenu();
            $menuButton.focus();
        }
    });
    
    $menu.find('.menu-item-has-children > a, .page_item_has_children > a').on('click touchstart', function(e) {
        if (!isMobile()) return;
        
        const $this = $(this);
        const $parentLi = $this.parent();
        const $submenu = $parentLi.find('ul').first();
        
        if ($submenu.length) {
            e.preventDefault();
            
            $menu.find('.menu-item-has-children, .page_item_has_children')
                .not($parentLi)
                .removeClass('focus')
                .find('ul')
                .slideUp(200);
            
            $parentLi.toggleClass('focus');
            $submenu.slideToggle(200);
        }
    });
    
    $menu.find('a').on('focus blur', function(e) {
        const $this = $(this);
        let $current = $this;
        
        while (!$current.hasClass('nav-menu') && $current.length) {
            if ($current.is('li')) {
                if (e.type === 'focus') {
                    $current.addClass('focus');
                } else {
                    $current.removeClass('focus');
                }
            }
            $current = $current.parent();
        }
    });
    
    resetNavigation();
});
