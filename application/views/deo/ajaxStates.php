	<option>Select Here</option>
<?php
	

	foreach ($records as $key => $state) 
	{
		?>
			<option value="<?php echo $state['state_id']; ?>"><?php echo strtoupper($state['state_name']);?></option>
		<?php
	}

?>