<!DOCTYPE html>
<html lang="fa">
@include('layouts.frontLayout.userHead')
@yield('css')
<body>
@include('layouts.frontLayout.userHeader')

@yield('content')

@include('layouts.frontLayout.userTail')
@include('layouts.frontLayout.userFooter')
@yield('js')
<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage (newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-" ) {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>
@include('common.message')
@include('common.errors')
</body>
</html>