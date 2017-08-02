<tr valign="top" id="service_options">
	<td class="titledesc" colspan="2" style="padding-left:0px">
	<strong><?php _e( 'Services', 'wf_dhl_wooCommerce_shipping' ); ?></strong><br><br>
		<table class="dhl_services widefat">
			<thead>
				<th class="sort">&nbsp;</th>
				<th><?php _e( 'Service Code(s)', 'wf_dhl_wooCommerce_shipping' ); ?></th>
				<th style="width:2%;"></th>
				<th><?php _e( 'Service(s)', 'wf_dhl_wooCommerce_shipping' ); ?></th>
			</thead>
			<tbody>
				<?php
					$sort = 0;
					$this->ordered_services = array();

					foreach ( $this->services as $code => $name ) {

						if ( isset( $this->custom_services[ $code ]['order'] ) ) {
							$sort = $this->custom_services[ $code ]['order'];
						}

						while ( isset( $this->ordered_services[ $sort ] ) )
							$sort++;

						$this->ordered_services[ $sort ] = array( $code, $name );

						$sort++;
					}

					ksort( $this->ordered_services );

					foreach ( $this->ordered_services as $value ) {
						$code = $value[0];
						$name = $value[1];
						?>
						<tr>
							<td class="sort"><input type="hidden" class="order" name="dhl_service[<?php echo $code; ?>][order]" value="<?php echo isset( $this->custom_services[ $code ]['order'] ) ? $this->custom_services[ $code ]['order'] : ''; ?>" /></td>
							<td><strong><?php echo $code; ?></strong></td>
							<td style="width:2%;"><input type="checkbox" name="dhl_service[<?php echo $code; ?>][enabled]" <?php checked( ( ! isset( $this->custom_services[ $code ]['enabled'] ) || ! empty( $this->custom_services[ $code ]['enabled'] ) ), true ); ?> /></td>
							<td><label name="dhl_service[<?php echo $code; ?>][name]" ><?php echo $name; ?></label> </td>
							
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</td>
</tr>
<style>
.dhl_services
{
	border-spacing: 0;
    width: 51.5%;
    clear: both;
    margin: 0;
	border: 1px solid #e5e5e5;
    box-shadow: 0 1px 1px rgba(0,0,0,.04);
	background: #fff;
}

.dhl_services td {
	vertical-align: middle;
	padding: 4px 7px;
}
.dhl_services th {
	padding: 9px 7px;
}
.dhl_services th.sort {
	width: 16px;
	padding: 0 16px;
	height:3%;
}
.dhl_services td.sort {
	cursor: move;
	//width: 16px;
	padding: 0 16px;
	cursor: move;
	background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAAHUlEQVQYV2O8f//+fwY8gJGgAny6QXKETRgEVgAAXxAVsa5Xr3QAAAAASUVORK5CYII=) no-repeat center;
}
</style>
<script type="text/javascript">

	jQuery(window).load(function(){

		// Ordering
		jQuery('.dhl_services tbody').sortable({
		items:'tr',
		cursor:'move',
		axis:'y',
		handle: '.sort',
		scrollSensitivity:40,
		forcePlaceholderSize: true,
		helper: 'clone',
		opacity: 0.65,
		placeholder: 'wc-metabox-sortable-placeholder',
		start:function(event,ui){
		ui.item.css('baclbsround-color','#f6f6f6');
		},
		stop:function(event,ui){
		ui.item.removeAttr('style');
		dhl_services_row_indexes();
		}
		});

		function dhl_services_row_indexes() {
		jQuery('.dhl_services tbody tr').each(function(index, el){
		jQuery('input.order', el).val( parseInt( jQuery(el).index('.dhl_services tr') ) );
		});
		};

	});
</script>