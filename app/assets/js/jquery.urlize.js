/**
 * java -jar jsrun.jar app/run.js -p -a -t=templates/outline ../public/javascripts/urlize.js
 */

/**
 * See (http://jquery.com/).
 * @name jQuery
 * @class
 * See the jQuery Library (http://jquery.com/) for full details.
 */
(function($){  

    /**
     * See (http://jquery.com/)
     * @name jQuery.fn
     * @class
     * See the jQuery Library (http://jquery.com/) for full details.
     */
     
    /**
     * Transform your string to url thanks to urlize function
     * @name urlize
     * @constructor
     * @memberOf jQuery.fn
     */
    jQuery.fn.urlize = function(options){   
    
      /**
      * Object default settings, contain default settings
      * @private
      * @field
      * @name jQuery.fn.urlize.defaultSettings
      * @type Object
      */
      var defaultSettings = jQuery.extend({
        destination: '',
        // Can be '-' or '_'
        separator: '-',
        // If you need more pattern : http://www.pjb.com.au/comp/diacritics.html
        replacement_patterns: {
          'a': ['\340', '\341', '\342', '\343', '\344', '\345', '\346'], // à,á,â,ã,ä,å,æ
          'c': ['\347'], // ç
          'e': ['\351', '\350', '\352', '\353'], // é,è,ê,ë
          'i': ['\354', '\355', '\356', '\357'], // ì,í,î,ï
          'o': ['\360', '\362', '\363', '\364', '\365', '\366', '\370'], // ð,ò,ó,ô,õ,ö,ø
          'u': ['\371', '\372', '\373', '\374'], // ù,ú,û,ü
          'y': ['\375', '\376', '\377', '\374'] // ý,þ,ÿ
          // ěščřžýáíéďťňů
        },
        limit: 40
      }, options);  
      
      /**
      * Object settings, contain default settings and options
      * @private
      * @field
      * @name jQuery.fn.urlize.settings
      * @type Object
      */
      var settings = $.extend({}, defaultSettings, options);
      
      /**
       * Transform a string to an url
       * @static
       * @function
       * @name jQuery.fn.urlize.toUrl
       * @param {String} str String to transform
       */
      this.toUrl = function(str){
        var separator = Boolean(settings.separator) ? settings.separator : '-';
        var separator_competitor = separator == '-' ? '_' : '-';
    
        // Only lowercase
        str = str.toLowerCase();
        // Replace spaces at the beginning and the end
        str = $.trim(str);
        // Replace all space by the separator
        str = str.replace(/ /gi, separator);
    
        // Replace the patterns by the key caractere
        $.each(settings.replacement_patterns, function(caractere, patterns){
          $.each(patterns, function(key, pattern){
            str = str.replace(new RegExp(pattern, 'gi'), caractere);
          });
        });
    
        // We only allow 0 to 9, a to z and separator
        str = str.replace(/[^a-z0-9-_]/gi, '');
    
        // Remove competitor separator
        str = str.replace(new RegExp(separator_competitor, 'gi'), separator);
    
        // Remove doublons
        str = str.replace(/--/gi, separator);
        str = str.replace(/--/gi, separator);
        str = str.replace(/__/gi, separator);
        str = str.replace(/__/gi, separator);
        
        return str;
      };
    
      /**
       * Define destination selector
       * @function
       * @inner
       * @name jQuery.fn.urlize#defineDestination
       * @param {String} selector Define the new selector
       */
      var defineDestination = function(selector){
        settings.destination = Boolean(settings.destination) ? settings.destination : selector.attr('id');
      }
      
      /**
       * @ignore
       */
      this.intialize = function() {
        var self = this;
        
        defineDestination($(this));
        $(this).keyup(function(e){
          $('#'+ settings.destination).val(self.toUrl($(this).val()).substring(0, settings.limit));
        });
      };
      
      return this.intialize();
      //return this.each(function() {  });  
    };
    
    })(jQuery);