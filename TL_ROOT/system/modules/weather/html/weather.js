/*
 * @author		Stefan Gandlau <stefan@gandlau.net>
 * @package		weather
 * @copyright	2012 Stefan Gandlau
 */

var clsWeather = new Class({
	wList: false,
	wSearch: false,
	wBtn: false,
	
	searchResultHeadline: 'Wählen Sie einen Ort aus:',
	
	initialize: function(strSearch, btnSearch, objList, objField) {
		this.wList = objList;
		this.wSearch = strSearch;
		this.wBtn = btnSearch;
		this.wField = objField;
		
		this.wBtn.addEvent('click', function() {
			this.searchWeatherLocation(this.wSearch.value, $('ctrl_weather_culture').value);
		}.bind(this));
		this.wSearch.addEvent('keypress', function(e) {
			if(e.key == 'enter') {
				this.searchWeatherLocation(this.wSearch.value, $('ctrl_weather_culture').value);
				return(false);
			}
		}.bind(this));
	},
	
	searchWeatherLocation: function(strSearch, wculture) {
		if(strSearch.length == 0) return;
		
		new Request.Contao({
			'url': document.location.href,
			'method': 'post',
			'data': 'wlocation=' + strSearch +'&action=weather_search&wculture=' + wculture + '&isAjaxRequest=1&REQUEST_TOKEN=' + REQUEST_TOKEN,
			onSuccess: function(txt, resp) {
				this.wList.empty();
				if(resp.ERROR == 0) {
					u = new Element('ul');
					u.addClass('weather_search_results');
					resp.DATA.each(function(item, index) {
						e = new Element('li');
						e.set('html', item.title);
						e.addEvent('click', function(){
							this.wField.value = item.id;
							$('weather_current_title').set('html', item.title);
							$('ctrl_current_location').value = item.title;
						}.bind(this));
						u.appendChild(e);
					}.bind(this));
					
					hl = new Element('h5');
					hl.set('html', this.searchResultHeadline);
					this.wList.appendChild(hl);
					this.wList.appendChild(u);
					
				} else {
					this.wList.set('html', resp.MESSAGE);
				}
			}.bind(this)
		}).send();
	},
	
	
});


clsWeather.implement(new Events, new Options);
