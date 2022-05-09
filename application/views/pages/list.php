<div class="bg-white p-8 rounded-md w-full">
	<div class=" flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold"><?= $title ?></h2>
			<span class="text-xs">All products item</span>
		</div>
		<div class="flex items-center justify-between">
			<div class="lg:ml-40 ml-10 space-x-8">
				<button id="create-item" class="hover:bg-indigo-800 bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Add item to list</button>
			</div>
		</div>
	</div>
	<div id="create-toggle" class hidden>
		<div id="message"></div>
		<div class="flex">
			<?= form_open('lists/create', array('id' => 'create-form', "class" => 'grow')) ?>
			<div class="flex gap-5">
				<div class="relative z-0 mb-6 group grow">
					<input type="text" name="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
					<label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Item Name</label>
				</div>
				<div class="relative z-0 mb-6 group grow flex items-center gap-5">
					<div class="grow">
						<select name="category" id="category" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
							<option disabled selected>Select category...</option>
						</select>
						<label for="category" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Category</label>
					</div>
				</div>
			</div>
			<button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
			</form>
			<div class="flex gap-5">
				<div class="">
					<button type="button" id="show-category-form" class="text-white bg-indigo-600 hover:bg-indigo-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xl w-full sm:w-auto px-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+</button>
				</div>
				<div id="category-form" hidden>
					<?= form_open('categories/create', array('id' => 'create-category')) ?>
					<input type="text" id="new-category" name="new-category" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="Enter category name..." />
					<input type="submit" hidden>
				</div>
			</div>
		</div>
	</div>
	<div>
		<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
			<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
				<div id="success"></div>
				<table class="min-w-full leading-normal">
					<thead>
						<tr>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Product
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
								<div>Category</div>
								<select class="mt-2 px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider" name="category-filter" id="category-filter">
									<option selected value="null">No filter...</option>
								</select>
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider flex flex-col">
								Status
								<select class="mt-2 px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 tracking-wider" name="status-filter" id="status-filter">
									<option selected value="null">No status...</option>
									<option value="0">Not purchased</option>
									<option value="1">Purchased</option>
								</select>
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
								Created at
							</th>
							<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
							</th>
						</tr>
					</thead>
					<tbody id="shopping-table">
					</tbody>
				</table>
				<!-- <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
					<span class="text-xs xs:text-sm text-gray-900">
						Showing 1 to 4 of 50 Entries
					</span>
					<div class="inline-flex mt-2 xs:mt-0">
						<button class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
							Prev
						</button>
						&nbsp; &nbsp;
						<button class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
							Next
						</button>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>