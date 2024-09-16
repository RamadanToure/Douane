<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ url('assets/docs/logos/' . $log) }}" alt="Logo Dark" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ url('assets/docs/logos/' . $log) }}" alt="Logo Large Dark" height="60"> <!-- Ajout de height pour la version large -->
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/douane.png') }}" alt="Logo Douane" height="30"> <!-- Correction du chemin d'image -->
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/douane.png') }}" alt="Logo Large Light" height="60"> <!-- Ajout de height pour la version large -->
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <?php $listMenuEntete = App\Models\GiwuMenu::getListMenuTopIdEgaVari(0);?>
    @if(sizeof($listMenuEntete) != 0)
        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu">
                </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <!-- <li class="menu-title"><span data-key="t-menu">Menu</span></li> -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ url('/home')}}">
                                <i class="ri-home-4-line"></i> <span data-key="t-landing">Tableau de bord</span>
                                <span class="badge badge-pill bg-danger" data-key="t-new">.</span>
                            </a>
                        </li>
                        @foreach($listMenuEntete as $listMenuE)
                            <!-- Vérifier si le menu contien un sous menu -->
                            @if(sizeof(App\Models\GiwuMenu::getListMenuTopIdEgaVari($listMenuE->id_menu)) == 0)
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="{{url($listMenuE->route)}}">
                                        <i class="{{$listMenuE->menu_icon}}"></i> <span data-key="t-landing">{{$listMenuE->libelle_menu}}</span>
                                    </a>
                                </li>
                            @else

                                <?php $listMenuSousM1 = App\Models\GiwuMenu::getListMenuTopIdEgaVari($listMenuE->id_menu); ?>

                                <li class="nav-item"> <!--Dashboards -->
                                    <a class="nav-link menu-link" href="#giwu{{$listMenuE->id_menu}}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="giwu{{$listMenuE->id_menu}}">
                                        <i class="{{$listMenuE->menu_icon}}"></i> <span data-key="t-dashboards">{{$listMenuE->libelle_menu}}</span>
                                    </a>
                                    <div class="collapse menu-dropdown" id="giwu{{$listMenuE->id_menu}}">
                                        <ul class="nav nav-sm flex-column">
                                            @foreach($listMenuSousM1 as $listMenuSM1)
                                                <!-- Vérifier si le menu contien un sous menu -->
                                                <?php $listMenuSousM2 = App\Models\GiwuMenu::getListMenuTopIdEgaVari($listMenuSM1->id_menu); ?>
                                                @if(sizeof($listMenuSousM2) == 0)
                                                    <li class="nav-item">
                                                    <!-- <i class="{{$listMenuSM1->menu_icon}}"></i>  -->
                                                        <a href="{{url($listMenuSM1->route)}}" class="nav-link" data-key="t-analytics"> {{$listMenuSM1->libelle_menu}}</a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a href="#giwu{{$listMenuE->id_menu}}" class="nav-link" data-bs-toggle="collapse" role="button"
                                                            aria-expanded="false" aria-controls="giwu{{$listMenuE->id_menu}}" data-key="t-ecommerce">
                                                            {{$listMenuSM1->libelle_menu}}</a>
                                                        <div class="collapse menu-dropdown" id="giwu{{$listMenuE->id_menu}}">
                                                            <ul class="nav nav-sm flex-column">
                                                                @foreach($listMenuSousM2 as $listMenuSM2)
                                                                    <li class="nav-item">
                                                                        <a href="{{url($listMenuSM1->route)}}" class="nav-link" data-key="t-products"> {{$listMenuSM2->libelle_menu}} </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </li>
                                                @endif

                                            @endforeach
                                        </ul>
                                    </div>
                                </li> <!-- end Dashboard Menu -->
                            @endif
                        @endforeach
                    </ul>

            </div>
            <!-- Sidebar -->
        </div>
    @else
        <span style="color:white; text-align:center; padding-top:13px; font-size:20px" >Aucun menu n'est affecté à votre rôle.</span>
    @endif

    <div class="sidebar-background"></div>
</div>
