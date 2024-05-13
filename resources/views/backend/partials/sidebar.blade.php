<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Primary menu-->
    <div id="kt_aside_menu_wrapper" class="app-sidebar-menu flex-grow-1 hover-scroll-y scroll-lg-ps my-5 pt-8"
         data-kt-scroll="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
         data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
        <!--begin::Menu-->
        <div id="kt_aside_menu"
             class="menu menu-rounded menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-6"
             data-kt-menu="true">
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                 class="menu-item here show py-2">
                <span class="menu-link menu-center">
										<span class="menu-icon me-0">
											<i class="ki-outline ki-home-2 fs-1"></i>
										</span>
									</span>
                <div class="menu-sub menu-sub-dropdown px-2 py-4 w-250px mh-75 overflow-auto">
                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Inicio</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link active" href="{{ route('dashboard') }}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                 class="menu-item py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
										<span class="menu-icon me-0">
											<i class="ki-outline ki-notification-status fs-1"></i>
										</span>
									</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Configuración</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('backend.configuration.showroom.index') }}"
                            title="Showrooms de todo el pais" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">Showrooms</span>
                        </a>
                        <!--end:Menu link-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link"
                               href="{{ route('backend.configuration.city.index') }}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                                <span class="menu-title">Ciudades</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link"
                               href="{{ route('backend.configuration.agent.index') }}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                                <span class="menu-title">Agentes</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                 class="menu-item py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
										<span class="menu-icon me-0">
											<i class="ki-outline ki-abstract-35 fs-1"></i>
										</span>
									</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown px-2 py-4 w-250px mh-75 overflow-auto">
                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Contactos</span>
                        </div>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('backend.quote.index') }}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">Leads</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('backend.quote.index.online') }}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">Reservas con Pago Online</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('backend.quote.index.bank') }}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">Reservas con Transferencia</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('backend.whatsapp.index') }}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">Contactos Whatsapp</span>
                        </a>
                    </div>
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                 class="menu-item py-2">
                <!--begin:Menu link-->
                <span class="menu-link menu-center">
										<span class="menu-icon me-0">
											<i class="ki-outline ki-abstract-26 fs-1"></i>
										</span>
									</span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Vehículos</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('backend.vehicle.grade.index') }}">
												<span class="menu-icon">
                                                    <i class="ki-outline ki-car fs-2"></i>
												</span>
                            <span class="menu-title">Grados</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('backend.vehicle.color.index') }}">
												<span class="menu-icon">
													<i class="ki-outline ki-color-swatch fs-2"></i>
												</span>
                            <span class="menu-title">Colores</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('backend.vehicle.additional.index') }}">
												<span class="menu-icon">
													<i class="ki-outline ki-tag fs-2"></i>
												</span>
                            <span class="menu-title">Costos adicionales</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('backend.vehicle.model.index') }}">
												<span class="menu-icon">
													<i class="ki-outline ki-car-2 fs-2"></i>
												</span>
                            <span class="menu-title">Modelos</span>
                        </a>
                        <!--end:Menu link-->
                    </div>

                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link" href="{{ route('backend.vehicle.type.index') }}">
												<span class="menu-icon">
													<i class="ki-outline ki-car-3 fs-2"></i>
												</span>
                            <span class="menu-title">Tipos</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
            <!--begin:Menu item-->
{{--            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"--}}
{{--                 class="menu-item py-2">--}}
{{--                <!--begin:Menu link-->--}}
{{--                <span class="menu-link menu-center">--}}
{{--										<span class="menu-icon me-0">--}}
{{--											<i class="ki-outline ki-briefcase fs-1"></i>--}}
{{--										</span>--}}
{{--									</span>--}}
{{--                <!--end:Menu link-->--}}
{{--                <!--begin:Menu sub-->--}}
{{--                <div class="menu-sub menu-sub-dropdown px-2 py-4 w-200px w-lg-225px mh-75 overflow-auto">--}}
{{--                    <!--begin:Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <!--begin:Menu content-->--}}
{{--                        <div class="menu-content">--}}
{{--                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">Help</span>--}}
{{--                        </div>--}}
{{--                        <!--end:Menu content-->--}}
{{--                    </div>--}}
{{--                    <!--end:Menu item-->--}}
{{--                    <!--begin:Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <!--begin:Menu link-->--}}
{{--                        <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs/base/utilities"--}}
{{--                           target="_blank" title="Check out over 200 in-house components" data-bs-toggle="tooltip"--}}
{{--                           data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">--}}
{{--												<span class="menu-bullet">--}}
{{--													<span class="bullet bullet-dot"></span>--}}
{{--												</span>--}}
{{--                            <span class="menu-title">Components</span>--}}
{{--                        </a>--}}
{{--                        <!--end:Menu link-->--}}
{{--                    </div>--}}
{{--                    <!--end:Menu item-->--}}
{{--                    <!--begin:Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <!--begin:Menu link-->--}}
{{--                        <a class="menu-link" href="https://preview.keenthemes.com/html/metronic/docs" target="_blank"--}}
{{--                           title="Check out the complete documentation" data-bs-toggle="tooltip" data-bs-trigger="hover"--}}
{{--                           data-bs-dismiss="click" data-bs-placement="right">--}}
{{--												<span class="menu-bullet">--}}
{{--													<span class="bullet bullet-dot"></span>--}}
{{--												</span>--}}
{{--                            <span class="menu-title">Documentation</span>--}}
{{--                        </a>--}}
{{--                        <!--end:Menu link-->--}}
{{--                    </div>--}}
{{--                    <!--end:Menu item-->--}}
{{--                    <!--begin:Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <!--begin:Menu link-->--}}
{{--                        <a class="menu-link" href="https://preview.keenthemes.com/metronic8/demo58/layout-builder.html"--}}
{{--                           title="Build your layout and export HTML for server side integration"--}}
{{--                           data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"--}}
{{--                           data-bs-placement="right">--}}
{{--												<span class="menu-bullet">--}}
{{--													<span class="bullet bullet-dot"></span>--}}
{{--												</span>--}}
{{--                            <span class="menu-title">Layout Builder</span>--}}
{{--                        </a>--}}
{{--                        <!--end:Menu link-->--}}
{{--                    </div>--}}
{{--                    <!--end:Menu item-->--}}
{{--                    <!--begin:Menu item-->--}}
{{--                    <div class="menu-item">--}}
{{--                        <!--begin:Menu link-->--}}
{{--                        <a class="menu-link"--}}
{{--                           href="https://preview.keenthemes.com/html/metronic/docs/getting-started/changelog"--}}
{{--                           target="_blank">--}}
{{--												<span class="menu-bullet">--}}
{{--													<span class="bullet bullet-dot"></span>--}}
{{--												</span>--}}
{{--                            <span class="menu-title">Changelog v8.2.3</span>--}}
{{--                        </a>--}}
{{--                        <!--end:Menu link-->--}}
{{--                    </div>--}}
{{--                    <!--end:Menu item-->--}}
{{--                </div>--}}
{{--                <!--end:Menu sub-->--}}
{{--            </div>--}}
            <!--end:Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Primary menu-->
    <!--begin::Footer-->
    <div class="d-flex flex-column flex-center pb-4 pb-lg-8" id="kt_app_sidebar_footer">
        <!--begin::Menu toggle-->
        <a href="#" class="btn btn-icon btn-active-color-primary" data-kt-menu-trigger="{default:'click', lg: 'hover'}"
           data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ki-outline ki-night-day theme-light-show fs-2x"></i>
            <i class="ki-outline ki-moon theme-dark-show fs-2x"></i>
        </a>
        <!--begin::Menu toggle-->
        <!--begin::Menu-->
        <div
            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
            data-kt-menu="true" data-kt-element="theme-mode-menu">
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
										<span class="menu-icon" data-kt-element="icon">
											<i class="ki-outline ki-night-day fs-2"></i>
										</span>
                    <span class="menu-title">Claro</span>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
										<span class="menu-icon" data-kt-element="icon">
											<i class="ki-outline ki-moon fs-2"></i>
										</span>
                    <span class="menu-title">Oscuro</span>
                </a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
										<span class="menu-icon" data-kt-element="icon">
											<i class="ki-outline ki-screen fs-2"></i>
										</span>
                    <span class="menu-title">Sistema</span>
                </a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Footer-->
</div>
