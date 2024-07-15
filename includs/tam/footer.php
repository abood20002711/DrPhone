<div class="footer"></div>
<!-- Main js file -->
<script src="<?php echo $js; ?>backend.js"></script>
<script src="<?php echo $js; ?>dashbord.js"></script>
<!-- bootstrap js -->
<script src="<?php echo $js; ?>bootstrap.min.js"></script>
<!-- <script src="<?php echo $js; ?>jquery-migrate-1.4.1.min.js"></script> -->
<!-- Table Script -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<!-- countries script -->
<script src="layout/js/countries.js"></script>
<!-- Phone Script -->
<script src="layout/phone-number-with-country-code/build/js/intlTelInput.js"></script>
<script>
  // Vanilla Javascript
  var input = document.querySelector("#phone");
  window.intlTelInput(input, ({
    // options here
  }));

  $(document).ready(function () {
    $('.iti__flag-container').click(function () {
      var countryCode = $('.iti__selected-flag').attr('title');
      var countryCode = countryCode.replace(/[^0-9]/g, '')
      $('#phone').val("");
      $('#phone').val("+" + countryCode + " " + $('#phone').val());
    });
  });
</script>
<!-- Show Table -->
<script>            
  $(document).ready(function () {
    $('#example').DataTable();
   });

</script>



</body>

</html>