						<script src="inc/simplescrollup.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/jquery/jquery.min.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/popper.js/popper.min.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/bootstrap/bootstrap.min.js"></script>
						
						<script src="<?php echo $urlComision; ?>assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/fancybox/jquery.fancybox.min.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/slick-carousel/slick/slick.js"></script>
						
						<script src="<?php echo $urlComision; ?>assets/js/hs.core.js"></script>
						<script src="<?php echo $urlComision; ?>assets/vendor/typedjs/typed.min.js"></script>
						<script src="<?php echo $urlComision; ?>assets/js/components/hs.header.js"></script>
						<script src="<?php echo $urlComision; ?>assets/js/helpers/hs.hamburgers.js"></script>
						<script src="<?php echo $urlComision; ?>assets/js/components/hs.dropdown.js"></script>
						<script src="<?php echo $urlComision; ?>assets/js/components/hs.popup.js"></script>
						<script src="<?php echo $urlComision; ?>assets/js/components/hs.carousel.js"></script>
						<script src="<?php echo $urlComision; ?>assets/js/components/hs.go-to.js"></script>
						
						<script src="<?php echo $urlComision; ?>assets/js/custom.js"></script>
						
						<script>
						  $(document).on('ready', function () {
		
						    $.HSCore.components.HSHeader.init($('#js-header'));
						    $.HSCore.helpers.HSHamburgers.init('.hamburger');
						
						    $('.js-mega-menu').HSMegaMenu({
						      event: 'hover',
						      pageContainer: $('.container'),
						      breakpoint: 991
						    });
						
						    $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
						      afterOpen: function () {
						        $(this).find('input[type="search"]').focus();
						      }
						    });
						
						    $.HSCore.components.HSPopup.init('.js-fancybox');
						
						    $.HSCore.components.HSCarousel.init('.js-carousel');				    
						
						    $.HSCore.components.HSGoTo.init('.js-go-to');
						  });
						</script>	