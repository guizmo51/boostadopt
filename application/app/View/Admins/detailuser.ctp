<h1> Infos utilisateur</h1>
<table class="table table-bordered table-striped">
<tr>
	<td>ID</td>
	<td><?php echo $user['User']['id']; ?></td>
</tr>
<tr>
	<td>AID</td>
	<td><?php echo $user['User']['aid']; ?></td>
</tr>
<tr>
	<td>token</td>
	<td><?php echo $user['User']['token']; ?></td>
</tr>
<tr>
	<td>login</td>
	<td><?php echo $user['User']['login']; ?></td>
</tr>
<tr>
	<td>crédits</td>
	<td><?php echo $user['User']['credits']; ?></td>
</tr>
<tr>
	<td>clé de parrainage</td>
	<td><?php echo $user['User']['parrainage_key']; ?></td>
</tr>
<tr>
	<td>last_login</td>
	<td><?php echo $user['User']['last_login']; ?></td>
</tr>
<tr>
	<td>service</td>
	<td><?php echo $user['User']['service']; ?></td>
</tr>
</table>
<br/>
<h1>Ajouter / retirer points </h1>
<form onsubmit="javascript: return confirm('Etes vous sur ?');" role="form" method="post" action="/admins/addBonusMalus">
<div class="input-group">
<input type="number" name="amount" class="form-control" />
<span class="input-group-btn">
<button class="btn btn-default" type="submit" name="+">+</button>
<button class="btn btn-default" type="submit" name="-">-</button>
<input type="hidden" name="id_user" value="<?php echo $user['User']['id']; ?>" />
</span>
</div>
</form>
<br/>
<h1>Rechargements</h1>
<table class="table table-bordered table-striped">
<tr>
	<th>ID</th>
	<th>Date</th>
	<th>Montant</th>
	<th>Crédit avant</th>
	<th>Crédit après</th>
	<th>ID transaction</th>
	<th>(user _id)</th>
	<th>(coupons _id)</th>
</tr>
<?php foreach($user['Rechargement'] as $rechargement){?>
<tr>
	<td><?php echo $rechargement['id'];?></td>
	<td><?php echo $rechargement['date'];?></td>
	<td><?php echo $rechargement['credit_value'];?></td>
	<td><?php echo $rechargement['credit_before'];?></td>
	<td><?php echo $rechargement['credit_after'];?></td>
	<td><?php echo $rechargement['id_transaction'];?></td>
	<td><?php echo $rechargement['users_id'];?></td>
	<td><?php echo $rechargement['coupons_id'];?></td>
</tr>
<?php } ?>
</table>
<?php if (isset($parrain)){?>
	 
<h1> Infos sur le parrain</h1>
<p><?php echo $this->Html->link($parrain['User']['login'], array('controller'=>'admins', 'action'=>'detailuser', $parrain['User']['id']))?></p>
<?php
}
?>
<h1> Infos sur les fillots</h1>
<ul>
<?php foreach ($user['Filleuls'] as $key => $filleul) { ?>
<li><?php echo $this->Html->link("Filleul ".$key, array('controller'=>'admins', 'action'=>'detailuser', $filleul['filleul_id']))?></li>
<?php } ?>
</ul>


