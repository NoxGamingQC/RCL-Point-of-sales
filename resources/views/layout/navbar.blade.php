<nav class="navbar navbar-expand-lg bg-body-tertiary no-print">
<div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="/logo.png" alt="{{env('NAME')}}" height="30px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dashboard">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transactions">Transactions</a>
            </li>
        </ul>
        <form class="d-flex" method="get" action="/logout">
            <button class="nav-link" aria-disabled="true">Déconnexion</button>
        </form>
    </div>
</div>
</nav>