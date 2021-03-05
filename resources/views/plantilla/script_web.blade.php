<!--JavaScript at end of body for optimized loading-->
<script src="{{ asset('mdb/js/jquery.min.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('mdb/js/popper.min.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('mdb/js/bootstrap.min.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('animate/wow.min.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('mdb/js/mdb.min.js') }}" type="text/javascript" ></script>
        <script src="{{ asset('js/menu_lateral/mtree.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/menu_lateral/menulateral.min.js') }}" type="text/javascript"></script>
        <script> new WOW().init();</script>

        <script language="JavaScript">

            $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
            });

            function menu_lateral(){
                $("#list-categorias").addClass('mtree transit bubba');
            };

            $(document).ready(function() {

                /* Para el menu lateral*/
                $('.treeview-colorful').mdbTreeview();

                // Tooltips Initialization
                $(function () {
                $('[data-toggle="tooltip"]').tooltip()
                })

                /*En escritorio al pasar sobre un dropdown el hover se activa, en movil tenemos que hacer click*/
                $('.dropdown').hover(function() {
                    $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
                    }, function() {
                    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
                });

                $(function () {
                    $("#mdb-lightbox-ui").load("{{ asset('mdb/mdb-addons/mdb-lightbox-ui.html') }}");
                });


            });

        </script>