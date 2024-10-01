    <aside id="application-sidebar-brand"
        class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical h-screen z-[999] flex-shrink-0 border-r-[1px] w-[270px] border-gray-400  bg-white left-sidebar   transition-all duration-300">
        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="p-5">

            <a href="#" class="text-nowrap">
                <img src="{{ asset('assets/images/logos/logopgri2.png')}}" alt="Logo-Dark" />
            </a>


        </div>
        <div class="scroll-sidebar" data-simplebar="">
            <div class="px-6 mt-8">
                <nav class=" w-full flex flex-col sidebar-nav">
                    <ul id="sidebarnav" class="text-gray-600 text-sm">
                        <li class="text-xs font-bold pb-4">
                            <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                            <span>HOME</span>
                        </li>

                        <li class="sidebar-item">
                            @auth('admin')
                                <a class="sidebar-link gap-3 py-2 px-3  rounded-md  w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="ti ti-layout-dashboard  text-xl"></i> <span>Dashboard</span>
                                </a>
                            @endauth
                            @auth('web')
                                <a class="sidebar-link gap-3 py-2 px-3  rounded-md  w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                                    href="{{ route('dashboard') }}">
                                    <i class="ti ti-layout-dashboard  text-xl"></i> <span>Dashboard</span>
                                </a>
                            @endauth
                        </li>

                        <li class="text-xs font-bold mb-4 mt-8">
                            <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                            <span>KEGIATAN</span>
                        </li>

                        @auth('admin')
                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                                    href="{{ route('sessions.index') }}">
                                    <i class="ti ti-door-exit  text-xl"></i> <span>Data Sesi Pemilihan</span>
                                </a>
                            </li>
                        @endauth
                        @auth('web')
                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                                    href="{{ route('sesi.indexMulai') }}">
                                    <i class="ti ti-door-exit  text-xl"></i> <span>Sesi Pemilihan</span>
                                </a>
                            </li>
                        @endauth


                        @auth('admin')
                            <li class="text-xs font-bold mb-4 mt-8">
                                <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                                <span>DATA USER</span>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                                    href="{{ route('calon_ketua.index') }}">
                                    <i class="ti ti-user-hexagon  text-xl"></i> <span>Data Calon</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                                    href="{{ route('pemilih.index') }}">
                                    <i class="ti ti-pencil-check  text-xl"></i> <span>Data Pemilih</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link gap-3 py-2 px-3 rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                                    href="{{ route('users.index') }}">
                                    <i class="ti ti-user text-xl"></i> <span>Data User</span>
                                </a>
                            </li>
                        @endauth

                        {{-- <li class="text-xs font-bold mb-4 mt-8">
                        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                        <span>EXTRA</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                            href="./pages/icons.html">
                            <i class="ti ti-mood-happy  text-xl"></i> <span>Icons</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500"
                            href="./pages/sample-page.html">
                            <i class="ti ti-aperture  text-xl"></i> <span>Sample Page</span>
                        </a>
                    </li> --}}

                    </ul>
                </nav>
            </div>
        </div>

        <!-- Bottom Upgrade Option -->
        <div class="m-6  relative">
            <div class="bg-blue-500 p-5 rounded-md flex items-center justify-between">
                <div>
                    <h5 class="text-base font-semibold text-gray-700 mb-3">Pemilihan Ketua</h5>
                </div>
                <div class="-mt-12 -mr-2">
                    <img src="{{ asset('assets/images/profile/rocket.png')}}" class="max-w-fit" alt="profile" />
                </div>
            </div>
        </div>
        <!-- </aside> -->
    </aside>
