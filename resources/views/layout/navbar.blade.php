<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#" style="padding-top:5px;"><img alt="{{env('NAME')}}" src="{{env('LOGO')}}" style="width:75px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/dashboard">Tableau de bord</a></li>
                <li><a href="/transactions">Transactions</a></li>
                <li><a href="#">Rapports</a></li>
                <li><a href="#">Inventaire</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li style="cursor: pointer;"><a id="logout">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript">
$(document).ready(function() {   
    $('#logout').on('click', function() {
        $.ajax({
            url: '/logout',
            method: 'POST',
            data: {
                _token: $('#csrf').attr('content')
            },
            success: function() {
                window.location.href = '/';
            }
        });
    })
})
</script>