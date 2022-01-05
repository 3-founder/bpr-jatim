@extends('backend.template')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="metismenu-icon fa fa-{{$pageIcon}} icon-gradient bg-arielle-smile">
                        </i>
                    </div>
                    <div>
                        {{$pageTitle}}
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">User</div>
                            <div class="widget-subheading">Total user yang ada</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\User::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Cabang</div>
                            <div class="widget-subheading">Total cabang Bank UMKM</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\Kota::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-night-fade">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Binaan</div>
                            <div class="widget-subheading">Total UMKM Binaan</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\UmkmBinaan::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-vicious-stance">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Produk & Layanan</div>
                            <div class="widget-subheading">Total produk dan layanan yang disediakan</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\ItemProdukLayanan::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-amy-crisp">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Berita</div>
                            <div class="widget-subheading">Total berita yang ada</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\Berita::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-deep-blue">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Promo</div>
                            <div class="widget-subheading">Total promo yang ada</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\Promo::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-asteroid">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Epaper</div>
                            <div class="widget-subheading">Total epaper yang ada</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\Epaper::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-sunny-morning">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Penghargaan</div>
                            <div class="widget-subheading">Total penghargaan yang diraih</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\Penghargaan::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-malibu-beach">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Kantor Kas</div>
                            <div class="widget-subheading">Total kantor kas yang ada</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ \App\Models\JaringanKantor::count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-card card">
            <div class="card-header">
                Profil Perusahaan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php
                        $profil = \App\Models\Profil::first();
                    @endphp
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Kantor Pusat</th>
                                <td>{{ $profil->kantor_pusat }}</td>
                            </tr>
                            <tr>
                                <th>Facebook</th>
                                <td>{{ $profil->facebook }}</td>
                            </tr>
                            <tr>
                                <th>Instagram</th>
                                <td>{{ $profil->instagram }}</td>
                            </tr>
                            <tr>
                                <th>Youtube</th>
                                <td>{{ $profil->youtube }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $profil->email }}</td>
                            </tr>
                            <tr>
                                <th>Telp.1</th>
                                <td>{{ $profil->telepon1 }}</td>
                            </tr>
                            <tr>
                                <th>Telp.2</th>
                                <td>{{ $profil->telepon2 }}</td>
                            </tr>
                            <tr>
                                <th>Telp.3</th>
                                <td>{{ $profil->telepon3 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Orders</div>
                            <div class="widget-subheading">Last year expenses</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>1896</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Clients</div>
                            <div class="widget-subheading">Total Clients Profit</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>$ 568</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Followers</div>
                            <div class="widget-subheading">People Interested</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>46%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Products Sold</div>
                            <div class="widget-subheading">Revenue streams</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning"><span>$14M</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                            Sales Report
                        </div>
                        <ul class="nav">
                            <li class="nav-item"><a href="javascript:void(0);" class="active nav-link">Last</a></li>
                            <li class="nav-item"><a href="javascript:void(0);"
                                    class="nav-link second-tab-toggle">Current</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-eg-77">
                                <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                    <div class="widget-chat-wrapper-outer">
                                        <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                            <canvas id="canvas"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">
                                    Top Authors</h6>
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container">
                                        <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                src="assets/images/avatars/9.jpg" alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Ella-Rose Henry
                                                            </div>
                                                            <div class="widget-subheading">Web Developer
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="font-size-xlg text-muted">
                                                                <small class="opacity-5 pr-1">$</small>
                                                                <span>129</span>
                                                                <small class="text-danger pl-2">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                src="assets/images/avatars/5.jpg" alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Ruben Tillman</div>
                                                            <div class="widget-subheading">UI Designer</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="font-size-xlg text-muted">
                                                                <small class="opacity-5 pr-1">$</small>
                                                                <span>54</span>
                                                                <small class="text-success pl-2">
                                                                    <i class="fa fa-angle-up"></i>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                src="assets/images/avatars/4.jpg" alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Vinnie Wagstaff
                                                            </div>
                                                            <div class="widget-subheading">Java Programmer
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="font-size-xlg text-muted">
                                                                <small class="opacity-5 pr-1">$</small>
                                                                <span>429</span>
                                                                <small class="text-warning pl-2">
                                                                    <i class="fa fa-dot-circle"></i>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                src="assets/images/avatars/3.jpg" alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Ella-Rose Henry
                                                            </div>
                                                            <div class="widget-subheading">Web Developer
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="font-size-xlg text-muted">
                                                                <small class="opacity-5 pr-1">$</small>
                                                                <span>129</span>
                                                                <small class="text-danger pl-2">
                                                                    <i class="fa fa-angle-down"></i>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                src="assets/images/avatars/2.jpg" alt="">
                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div class="widget-heading">Ruben Tillman</div>
                                                            <div class="widget-subheading">UI Designer</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="font-size-xlg text-muted">
                                                                <small class="opacity-5 pr-1">$</small>
                                                                <span>54</span>
                                                                <small class="text-success pl-2">
                                                                    <i class="fa fa-angle-up"></i>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Bandwidth Reports
                        </div>
                        <div class="btn-actions-pane-right">
                            <div class="nav">
                                <a href="javascript:void(0);"
                                    class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Tab
                                    1</a>
                                <a href="javascript:void(0);"
                                    class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Tab
                                    2</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-eg-55">
                            <div class="widget-chart p-3">
                                <div style="height: 350px">
                                    <canvas id="line-chart"></canvas>
                                </div>
                                <div class="widget-chart-content text-center mt-5">
                                    <div class="widget-description mt-0 text-warning">
                                        <i class="fa fa-arrow-left"></i>
                                        <span class="pl-1">175.5%</span>
                                        <span class="text-muted opacity-8 pl-1">increased server
                                            resources</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2 card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">63%
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Generated Leads
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            aria-valuenow="63" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 63%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">32%
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Submitted Tickers
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 32%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">71%
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Server Allocation
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            aria-valuenow="71" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 71%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">41%
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Generated Leads
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            aria-valuenow="41" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 41%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
    </div>
@endsection
