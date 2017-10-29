
(function() {

  function ajax(url, ok, error){
    error = error || function(){};
    var request = new XMLHttpRequest();
    request.open('GET', url, true);

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        var data = JSON.parse(request.responseText);
        if(data) {
          ok(data, url);
        }else {
          error(url);
        }
      } else {
        error(url);
      }
    };

    request.onerror = function() {
      error(url);
    };

    request.send();
  }
  function e(tag, attributes, children){
    var key;
    var el = document.createElement(tag);
    if(attributes){
      for(key in attributes){
        if(attributes.hasOwnProperty(key)){
          var value = attributes[key];
          el.setAttribute(key, value);
        }
      }
    }
    if(children && children.length > 0){
      for(key in children){
        if(children.hasOwnProperty(key)){
          var child = children[key];
          el.appendChild(child);
        }
      }
    }
    return el;
  }
  function t(text){
    return document.createTextNode(text);
  }

  function SowpMap(el){
    this.el = el;
    this.initMap();
    this.icons = {};
  }

  SowpMap.prototype.initMap = function() {
    this.map = L.map(this.el).setView([52.232222, 21.008333], 6);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(this.map);
  };

  SowpMap.prototype.addMarker = function(lat, lng, url, icon){
    var marker = L.marker([lat, lng], {icon: icon}).addTo(this.map);
    marker.bindPopup("Loading...");
    marker.on('click', function(ev){
        console.log('popupopen');
        var popup = ev.target.getPopup();
        ajax(url, function(data) {
          console.log(t(data.title));
          var html = e(
            'div', null,
            [
              e('h1', null, [t(data.title)]),
              e('p', null, [t(data.description)]),
              e('ul', null,
                data.attachments.map(function(attachment){
                  return e(
                    'li', {},
                    [
                      e(
                        'a', {'href': attachment.path},
                        [t(attachment.title || attachment.name)]
                      )
                    ]
                  )
                })
              ),
            ]
          );
          console.log({data, html});
          popup.setContent(html);
          popup.update();
        });
      });
  };

  SowpMap.prototype.fetchMap = function(map_url) {
    ajax(map_url, (function(data) {
      data.points.forEach(function(item) {
        var icon = this.getIconInstance(item.icon.url);
        this.addMarker(item.lat, item.lng, item._links._self, icon);
      }.bind(this));
    }).bind(this));
  };

  SowpMap.prototype.fetchPoint = function(point_url) {
    ajax(point_url, (function(item) {
      console.log(item);
      var icon = this.getIconInstance(item.icon.url);
      this.addMarker(item.lat, item.lng, item._links._self, icon);
    }).bind(this));
  };


  SowpMap.prototype.getIconInstance = function(icon_url){
    if(this.icons[icon_url]){
      return this.icons[icon_url];
    }
    var icon = L.icon({
      iconUrl: icon_url,
      shadowUrl: icon_url,
      iconSize: [24, 30],
      shadowSize: [0, 0]
    });
    this.icons[icon_url] = icon;
    console.log(icon);
    return icon;
  };

  Array.prototype.slice.call(document.querySelectorAll('[data-sowp-map][data-sowp-map-url]')).forEach(function(el){
    var map = new SowpMap(el);
    map.fetchMap(el.getAttribute('data-sowp-map-url'));
  });

  Array.prototype.slice.call(document.querySelectorAll('[data-sowp-map][data-sowp-point-url]')).forEach(function(el){
    var map = new SowpMap(el);
    map.fetchPoint(el.getAttribute('data-sowp-point-url'));
  });

}) ();
