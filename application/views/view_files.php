<?php if(!$this->session->userdata('is_logged_in')){ redirect('login'); die; }
$dados = $this->session->userdata();  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Gerenciador de arquivos - Brasmar</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('asset/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        .container{
            margin-top:30px;
            margin-bottom:30px;
        }
        .box{
            margin:auto;
            padding: 10px 0;
            text-align:center;
            border:2px dashed #aaa;
            background-color: #eee;
        }
        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .inputfile + label {
            max-width: 80%;
            font-size: 1.25rem;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            padding: 0.625rem 1.25rem;
        }
        .inputfile + label svg {
            width: 1em;
            height: 1em;
            vertical-align: middle;
            fill: currentColor;
            margin-top: -0.25em;
            margin-right: 0.25em;
        }
        .inputfile + label {
            color: #aaa;
        }
        .inputfile:focus + label,
        .inputfile.has-focus + label,
        .inputfile + label:hover {
            color: #666;
        }
        .inputfile + label figure {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #fff;
            display: block;
            padding: 20px;
            margin: 0 auto 10px;
            border:2px dashed #aaa;
        }
        .inputfile:focus + label figure,
        .inputfile.has-focus + label figure,
        .inputfile + label:hover figure {
            background-color: #666;
        }
        .inputfile + label svg {
            width: 100%;
            height: 100%;
            fill: #aaa;
        }
        label strong{
            font-size:18pt;
        }
        .form-group{
            margin:10px 0;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Bem Vindo <strong><?php echo $dados['login']; ?></strong> <a href="<?php echo site_url('logout') ?>" class="btn btn-danger">Sair</a> 
                <p><?php echo $this->session->flashdata('msg_info'); ?></p>
                <?php if ($dados['nivel'] == 1) {  ?>
                    <a href="<?php echo site_url('clientes') ?>" class="btn btn-success">Cadastrar Usuário</a>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="box">
                        <input type="file" name="myfiles[]" id="files" class="inputfile" data-multiple-caption="{count} arquivos selecionados" multiple />
                        <label for="files"><figure><svg xmlns="https://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <strong>Escolha os Arquivos</strong></label>
                    </div>
                    <div class="form-group">
                        <select name='user' id='user' class="form-group">
                            <option value selected disabled>Selecione um usuário...</option>
                            <?php if(!empty($users)): foreach($users as $user): ?>
                                <option value="<?php echo $user['Id']; ?>"><?php echo $user['usuario']; ?></option>
                                 <?php endforeach; endif; ?>
                        <input type="submit" name="mysubmit" class="btn btn-primary btn-block" value="Clique aqui para Salvar o Arquivo"/>
                    </div>
                </form>
                <?php  } ?>
            </div>
        </div>
        <div class="row">
            <?php if(!empty($files)): foreach($files as $file): 
               // var_dump($file);
                ?>
            <div class="col-md-3">

                <embed src="<?php
$formatos = ['txt', 'jpg', 'jpeg', 'png', 'gif'];
if(in_array(pathinfo($file['file_name'],PATHINFO_EXTENSION), $formatos)) {
echo base_url('upload/'.$file['file_name']);
}else {
echo base_url('upload/rar.jpg');
}
?>" width="100%" height="180"/>
                <div class="btn-group btn-group-justified" role="group">
                    <a href="<?php echo base_url('upload/'.$file['file_name']); ?>" class="btn btn-success" download>Download</a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#my-<?php echo $file['id'] ?>">Visualizar</a>
                </div>
                <p><strong> <?php echo $file['file_name'] ?> </strong></p>
                <div class="modal fade" id="my-<?php echo $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="label-<?php echo $file['id'] ?>">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="label-<?php echo $file['id'] ?>"><?php echo $file['file_name'] ?></h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <span> <strong>Criado</strong>: <?php echo $file['created'] ?></span> 
                                    <span> <strong>Modificado</strong>: <?php echo $file['modified'] ?></span>
                                </p>
                                <embed src="<?php echo base_url('upload/'.$file['file_name']); ?>" width="100%"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
                <p>Arquivo não encontrado.....</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('asset/js/jquery.min.js') ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('asset/js/bootstrap.min.js') ?>"></script>
    <script>
        var inputs = document.querySelectorAll( '.inputfile' );
        Array.prototype.forEach.call( inputs, function( input ){
            var label	 = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                else
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    label.querySelector( 'strong' ).innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });
        });
    </script>
</body>
</html>