<?php
require_once  dirname(__FILE__, 3) . '/config.php';
?>
<script>
    async function checkAdmin() {
        let main = $('body>main');
        main.detach();
        let username = prompt("Username", "");
        let password = prompt("Password", "");
        let data = {
            'username': username,
            'password': password
        }
        $.ajax({
            'url': "<?php echo ROOT_URL_ACTION . 'allow-user.php'; ?>",
            'type': 'POST',
            'data': data,
            success: function(resposnse) {
                let res = JSON.parse(resposnse);
                console.log(res);
                for (const key in res) {
                    if (res[key] === 1) {
                        $(document.body).prepend(main);
                        if (main.hasClass('d-none')) {
                            main.removeClass('d-none');
                        }
                    }
                }
            },
        })
    }
    <?php 
    $req_uri = $_SERVER['REQUEST_URI'];
    $path_array = (explode('/',$req_uri));
    if(in_array('add-question',$path_array)){
        ?>
        checkAdmin();
        <?php
    }

    ?>
</script>