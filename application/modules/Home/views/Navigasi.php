<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	    <ul class="nav navbar-nav">
	    	<li><a href="<?php echo base_url() . 'index.php/Home/'?>"><i class="fa fa-home" ></i></a></li>
	    <?php 
	    	$a = $this->db->query('SELECT * FROM tb_menu WHERE induk_menu = 0');
	    	foreach ($a->result() as $key => $b) :
	    		//$c = $this->db->query('SELECT * FROM tb_menu WHERE induk_menu = '.$b->id_menu);
	    		$c = $this->db->query('
	    			SELECT m.*,c.id_content
	    			FROM tb_menu AS m
	    			LEFT JOIN tb_content AS c
	    			ON m.id_menu = c.id_menu
	    			WHERE m.induk_menu = '.$b->id_menu
	    		);
	    		/*$c = $this->db->query('SELECT * FROM tb_menu,tb_content WHERE tb_menu.id_menu = tb_content.id_menu AND tb_menu.induk_menu ='.$b->id_menu);*/
	    		if($c->num_rows() > 0){
	    			echo '<li class="dropdown">
            	<a href="'.base_url().$b->uri.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> '.$b->menu.' <span class="caret"></span></a>
            		<ul class="dropdown-menu">';
            	foreach($c->result() as $d) {
            		// $content = $this->db->query('SELECT * FROM tb_menu,tb_content WHERE tb_menu.induk_menu = tb_content.id_menu');
            		// foreach ($content->result() as $key => $cont) {
                	echo '<li><a href="'.base_url().$d->uri.$d->id_content.'"> '.$d->menu.' </a></li>';
            		// }
                }
                	echo '</ul>
                		</li>';
	    		}else{
	    				echo '<li><a href="'.base_url().$b->uri.'">'.$b->menu.'</a></li>';
	    		}
	    	endforeach;
	    ?>
	    </ul>
	</div>
</nav>