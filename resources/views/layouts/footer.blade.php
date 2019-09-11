  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">About</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; Laravel Test {{ date('Y') }}. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="#">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="/js/app.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){ console.log('loaded');});
  </script>
  <script>
  $(document).ready(function(){

    $('body').on('change', '#vehicle-makes', function(){
      var vehicle_make = $(this).val();

      if(vehicle_make){

        $.ajax({

          url: '/getModels/' + vehicle_make,
          type: 'GET',
          dataType: 'json',
          success: function(data){
            $('#vehicle-models').empty();

            $('#vehicle-models')
              .append('<option value="">-- Select Model</option>');

            $.each(data, function(key, value){
              $('#vehicle-models')
              .append('<option value="' + value.id + '">' + value.title + '</option>');
            });
          },
          error: function(){
            $('#vehicle-models').empty();

            $('#vehicle-models')
              .append('<option value="">-- Select Model</option>');
          }
        })      

      }

    });
  });
  </script>
  @stack('scripts')