
<base href="<?php echo base_url(); ?>">
<link href="assets1/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="assets1/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets1/admin_js/jquery.min.js" type="text/javascript"></script>

<style type="text/css">
    body { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}
    .error-template {padding: 40px 15px;text-align: center;}
    .error-actions {margin-top:15px;margin-bottom:15px;}
    .error-actions .btn { margin-right:10px; }
</style>

<script>
function goBack() {
    window.history.back();
}
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h2>Oooopppsss....</h2>
                <div class="error-details">
                    
                </div>
                
                <h1 style="color: red;">
                    Your account is temporary blocked.
                </h1>
                <div class="error-actions">
                    <a onclick="goBack()" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Go To Back  </a>
                </div>
            </div>
        </div>
    </div>
</div>