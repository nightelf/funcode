// restaurant namespace
var restaurant = {};
restaurant.data = [];

// gets the json data.
restaurant.getData = function() {
	$.getJSON( "getRestaurantData.php", function(data) {
		restaurant.data = data;
		restaurant.index = new restaurant.indexer(data);
	});	
};

// lists the json data in the app.
restaurant.listData = function(substring) {
	var r = restaurant.index.get(substring.toLowerCase());
	var li; var name; var cuisine;
	$('#list').html('');
	if (r.length) {
		for (var i = 0; i < r.length; i++) {
			li = $('#rowTemplate li').clone()
			name =  restaurant.boldSearchTerm(substring, restaurant.data[r[i]].restaurant_name);
			li.find('.restaurant').html(name);
			cuisine = restaurant.boldSearchTerm(substring, restaurant.data[r[i]].cuisine_type);
			li.find('.cuisine').html(cuisine);
			$('#list').append(li);
		}
	} else{
		if (substring.length) {
			$('#list').append("<li><h3>No current search matches. Try something else.</h3></li>");
		} else {
			$('#list').append("<li><h3>Search restaurants or cuisine...</h3></li>");
		}
	}
};

// makes the search term bold with html.
restaurant.boldSearchTerm = function(substring, string) {
	if (string.substr(0,substring.length).toLowerCase() === substring.toLowerCase()) {
		string = "<strong class='boldSearch'>" + string.substr(0,substring.length) + "</strong>" + string.substr(substring.length)
	}
	return string;
}

// indexer object
restaurant.indexer = function(data) {
	
	// the index object.
	var index = {};
	
	// indexes a string for a particular row
	var indexItem = function (item, rowNum) {
		var substring;
		item = item.toLowerCase();
		for (var i = 1; i <= item.length; i++) {
			substring = item.substr(0, i);
			if (!index.hasOwnProperty(substring)) {
				index[substring] = [];
			}
			if (index[substring].indexOf(rowNum) === -1) {
				index[substring].push(rowNum);
			}
		}
	}
	
	// indexes a row.
	var indexRow = function(datum, rowNum) {
		for (var prop in datum) {
			if (datum.hasOwnProperty(prop)) {
				indexItem(datum[prop], rowNum);
			}
		}
	}
	
	// indexes all of the data.
	var indexData = function(data) {
		for (var i = 0; i < data.length; i++) {
			indexRow(data[i], i);
		}
	}
	
	// initiates the index.
	indexData(data);
	
	// gets an array of the rows matching the search string.
	this.get = function(search) {
		if (index.hasOwnProperty(search)) {
			return index[search];
		} else {
			return [];
		}
	}
	
	// constructor returns this.
	return this;
}

// sets the default indexer object until one is fetched from the server.
restaurant.index = restaurant.indexer([]);

