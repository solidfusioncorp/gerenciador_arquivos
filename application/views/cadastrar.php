   <?php if(!$this->session->userdata('is_logged_in')){ redirect('login/login'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $pagina; ?> - <?php echo $config->nome_fantasia; ?></title>
<link href="<?php echo base_url(); ?>asset/pdv/img/favicon.ico" rel="shortcut icon" type="img/vnd.microsoft.icon">
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/admin/css/dialog.css" type="text/css" />
<link href="<?php echo base_url(); ?>asset/pdv/css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet"/>

<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/plugins/jquery.effects.explode.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/plugins/jquery.effects.core.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/plugins/jquery.colorbox-min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/custom/elements.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/custom/general.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/custom/tables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/custom/media.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/custom/form.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/charts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin/js/jquery.flot.min.js"></script>

<meta charset="UTF-8"></head>

        <div class="maincontent noright">
          <div class="maincontentinner">
              
                <ul class="maintabmenu">
                  <li class="current"><a href="">Cadastrar Usuario</a></li>
                </ul><!--maintabmenu-->
                
                <div class="content">
                
                    <div class="contenttitle">
                      <h2 class="form"><span>Cadastro</span></h2>
                    </div><!--contenttitle-->
                                                                               
                    <?php $attributes = array('class' => 'stdform', 'id' => 'form1');echo form_open('usuarios', $attributes);?>
                    <input type="hidden" name="action" value="cadastrar"/>

                       
                       <p><label>Usuário</label>
                       <span class="field"><input type="text" name="usuario" class="mediuminput" required/></span></p>
                       
                                                  
                       <p><label>Senha</label>
                       <span class="field"><input type="password" name="senha" class="smallinput" /></span></p>
                       
                       <p><label>Confirmar Senha</label>
                       <span class="field"><input type="password" name="senha2" class="smallinput"required/></span></p>
                       
                       <p><label>Ativo</label>
                        <span class="formwrapper">
                            <input type="radio" name="status" value="1" checked/> Sim &nbsp;&nbsp;
                            <input type="radio" name="status" value="0"/> Não
                        </span></p>
                                                                        
                       <p><label>Nivel</label>
                       <span class="formwrapper">
                            <input type="radio" name="nivel" value="1" checked/> Admin &nbsp;&nbsp;
                            <input type="radio" name="nivel" value="2"/> Usuario
                        </span></p>
                                                                        
                       <br clear="all" />
                                                
                       <p class="stdformbutton">
                          <button class="submit radius2">Cadastrar</button>
                            <input type="reset" class="reset radius2" value="Limpar" />
                       </p>                        
                        
                    <?php echo form_close();?>
                                                            
                    <br clear="all" />
                    
                </div><!--content-->
                
            </div><!--maincontentinner-->
            <script>
      $(document).ready(function () {
         $('input').keypress(function (e) {
          var code = null;
          code = (e.keyCode ? e.keyCode : e.which);                
          return (code == 13) ? false : true;
         });
      });
      </script>