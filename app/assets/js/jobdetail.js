var benefitsLoaded = false;
var dataLoaded = false;

var converter = new showdown.Converter();

jQuery( document ).ready(function( $ ) {
    var hash = parseInt(window.location.hash.replace('#',''));    
    
    
    $.getJSON( "js/data/position.json", function( data ) {        
        renderDetail(data,hash);
    });

    $.getJSON( "js/data/benefit.json", function( data ) {        
        renderBenefits(data);
    });
});

function renderDetail(data,hash) {
    console.log(hash);
    var positionData = data.positions[hash];
    $('*[data-value]').each(function(e){        
        var input = positionData[$(this).data('value')];        
        
        switch ($(this).data('parser')) {
            case "uppercase":
                input = input.toUpperCase();
                break;
            case "markdown":
                input = converter.makeHtml(input);
            default:
                break;
        }
        
        if (input == "" && $(this).data('value') == "title") input="&nbsp";

        if ($(this).data('suffix') != undefined) input = input+$(this).data('suffix');

        if ($(this).data('location') != undefined) {
            if ($(this).data('location') == 'href') {
                $(this).attr('href',input);
            }
        } else {
            $(this).html(input);   
        }        
    });
    var dateSplit  = positionData.dateExpire.split(".");
    var expireDate = new Date(parseInt(dateSplit[2])+"-"+parseInt(dateSplit[1])+"-"+parseInt(dateSplit[0]));
    var today = new Date();
    console.log(expireDate,today);
    
    if (expireDate < today) {
        $('.applyButton').hide();
        $('.applyDate').html('Bohužel, na tuto pozici už není možne se přihlásit.<br>Datum pro podání přihlášek bylo <strong>'+positionData.dateExpire+'</strong>');
    }
    
    dataLoaded = true;
    unhideContent();
}

function renderBenefits(data){
    data = shuffleArray(data);
    data.forEach(item => {
        var randIndex = Math.floor(Math.random()*item.desc.length);
        var benefitItem = $('<div/>',{class:'benefitItem'}).css('background-image','url(/img/ilustrated-icons/benefits/'+item.icon).append(
            $('<h4/>').text(item.name)
        ).append(
            $('<p/>').text(item.desc[randIndex])
        );
        $('.benefitList').append(benefitItem)
    });
    benefitsLoaded = true;
    unhideContent();
}

function unhideContent() {
    if (benefitsLoaded && dataLoaded) {
        $('body').hide().removeClass('hidden').fadeIn(300);
        positionFloating();
    }
}


function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}