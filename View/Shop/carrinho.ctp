<ul class="carrinho">
<?php if(count($itens)>0) {
	foreach($itens as $k => $infoItem) { ?>
	<li>
		<div class="infoId">#<?php echo $infoItem['id']?></div>
		<div class="infoDescricao"><?php echo $infoItem['descricao']?></div>
		<div class="infoValor">
			<span class="valor">
				<?php echo $infoItem['v']?>
			</span>
			<span class="decimal">
				,<?php echo $infoItem['d']?>
			</span>				
		</div>
		<?php if($infoItem['id']!=$itens[count($itens)-1]['id']) { ?>
		<hr />
		<?php } ?>
	</li>
<?php } ?>
</ul>
<div class="dv-totalizador">
	<hr />
	<div class="infoValor">
		<span class="valor">
			<?php echo $vtotal?>
		</span>
		<span class="decimal">
			,<?php echo $dtotal?>
		</span>
	</div>
	<div class="noFloat">&nbsp;</div>
</div>
<?php } else { ?>
	A cesta esta vazia
<?php } ?>
<script language="javascript">
	atualizaTotalItens(<?php echo count($itens)?>);
</script>