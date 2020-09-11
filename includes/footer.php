	<script src="includes/js/jquery-3.3.1.min.js"></script> <!-- version 3.3.1 -->
	<script src="includes/js/jquery.sticky.js"></script>
	<script src="includes/js/jquery.backstretch.min.js"></script>
	<script src="includes/js/lightbox.min.js"></script>
	<script src="includes/js/jquery.parallax.js"></script>
	<script src="includes/js/jquery.flexslider-min.js"></script>
	<!-- <script src="includes/js/smoothscroll.js"></script> -->
	<script src="includes/js/fonction.js"></script>
	<script src="includes/js/chosen.jquery.min.js"></script>
	<script src="includes/js/jquery.magnific-popup.min.js"></script>
	<script defer src="includes/js/fontawesome-5.0.13.js"></script>
	<script>
	if($('#radioMuse').attr('checked'))
		$('.baseNITG').fadeOut();
	else
	{
		$('.baseMuse').fadeOut();
	}
	</script>
	<script>
		$("select").chosen();
		$('.open-popup-link').magnificPopup({
		  type:'inline',
		  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
		});
	</script>
</body>
<footer>
	
</footer>
</html>