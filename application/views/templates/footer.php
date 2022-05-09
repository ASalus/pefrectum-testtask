</div>

<script>
	$(document).ready(function(e) {

		//Load shopping list
		$('#shopping-table').on('loadList', () => {
			$('#shopping-table').html('');
			var status = $('#category-filter').val();
			var category = $('#status-filter').val();
			$.getJSON(`<?= base_url('lists/getList') ?>/${category}/${status}`, (response) => {
				var html = '';
				var wrapOpen = '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><div class = "flex items-center"><div class = "ml-3"><p class = "text-gray-900 whitespace-no-wrap">'
				var wrapClose = '</p></div></div></td>'
				var purchased = '<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight"><span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span><span class = "relative">Purchased</span></span>'
				var notPurchased = '<span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight"><span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span><span class = "relative">Not purchased</span></span>'
				if (response.item_name != undefined) {
					html += `<tr class="line-through" id='${response.id}'>`;
					html += wrapOpen + `<input id='${response.id}' class="checkbox" type="checkbox" ${response.status == true ? 'checked' : ''}/>` + wrapClose;
					html += wrapOpen + response.item_name.toUpperCase() + wrapClose;
					html += wrapOpen + response.category_name + wrapClose;
					status = response.status == true ? purchased : notPurchased;
					html += wrapOpen + status + wrapClose;
					html += wrapOpen + response.created_at + wrapClose;
					html += wrapOpen + `<button type="submit" id="${response.id}" class="tw-deleteBtn">Delete</button>` + wrapClose
					html += '</tr>';
				} else {
					$.each(response, function(key, value) {
						html += `<tr class="line-through" id='${value.id}'>`;
						html += wrapOpen + `<input id='${value.id}' class="checkbox" type="checkbox" ${value.status == true ? 'checked' : ''}/>` + wrapClose;
						html += wrapOpen + value.item_name + wrapClose;
						html += wrapOpen + value.category_name + wrapClose;
						status = value.status == true ? purchased : notPurchased;
						html += wrapOpen + status + wrapClose;
						html += wrapOpen + value.created_at + wrapClose;
						html += wrapOpen + `<button type="submit" id="${value.id}" class="tw-deleteBtn">Delete</button>` + wrapClose
						html += '</tr>';
					});
				}
				$('#shopping-table').append(html)
			})
		})

		$('#shopping-table').trigger('loadList')

		// Create new item
		$('#create-item').on('click', (event) => {
			$('#create-toggle').toggle('load')
			$('#category').trigger('loadCategories')
		});

		$('#create-form').on('submit', (event) => {
			event.preventDefault();
			$.post('<?= base_url('lists/create') ?>', $('#create-form').serialize(), function(response) {
				$('#message').html(response);
				$('#shopping-table').trigger('loadList')
			})
		})

		// Delete Item
		$(document).on('click', '.tw-deleteBtn', (event) => {
			var id = $(event.target).attr('id');
			$.post(`<?= base_url('lists/delete') ?>/${id}`, id, function(response) {
				$('#success').html(response);
				$('#shopping-table').trigger('loadList')
			})
		})

		//Check as purchased
		$(document).on('change', '.checkbox', (event) => {
			var id = $(event.target).attr('id');
			var status = $(event.target).is(':checked');
			$.post(`<?= base_url('lists/update') ?>/${id}`, {
					id: id,
					status: status
				},
				function(response) {
					$('#success').html(response);
					$('#shopping-table').trigger('loadList')
				})
		})

		//Load categories
		$('#category, #category-filter').on('loadCategories', (e) => {
			var target = e.target;
			if ($(target).attr('id') == 'category') {
				$(target).html('<option disabled="" selected="">Select category...</option>')
			} else {
				$(target).html('<option selected value="null">No filter...</option>')
			}
			$.getJSON('<?= base_url('categories/getCategories') ?>', (response) => {
				for (var i = 0; i < response.length; i++) {
					$(target).append('<option value="' + response[i].id + '">' + response[i].name + '</option>');
				}
			})
		})

		$('#category-filter').trigger('loadCategories')

		//Create category
		$('#show-category-form').on('click', (event) => {
			$('#category-form').toggle('load')
		});

		$('#create-category').on('submit', (event) => {
			event.preventDefault();
			$.post('<?= base_url('categories/create') ?>', $('#create-category').serialize(), (response) => {
				$('#message').html(response);
				$('#category, #category-filter').trigger('loadCategories');
				$('#category-form').toggle('load');
			});
		})

		//Filter trigger
		$('#category-filter, #status-filter').on('change', (e) => {
			$('#shopping-table').trigger('loadList')
		})
	})
</script>
</body>

</html>