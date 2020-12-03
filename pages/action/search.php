<div class="container-fluid">
<h2 class="text-center">Tìm kiếm Dữ Liệu Khách Hàng</h2><br />
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">Tìm Kiếm</span>
			<input type="text" name="search_text" id="search_text" placeholder="Tìm địa chỉ hoặc số điện thoại" class="form-control " style="z-index: 0;" />
		</div>
	</div>
	<br />
	<div id="result"></div>
	<div style="clear:both"></div>
</div>

<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"includes/logic/fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	$('#search_text').keyup(function(){
			var search = $(this).val();
			if(search != '')
			{
				load_data(search);
			}
			else
			{
				load_data();			
			}
		}
	);
});
</script>




