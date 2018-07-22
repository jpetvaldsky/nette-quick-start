jQuery( document ).ready(function( $ ) {
    initSearchFilter();

    $('#filterCategory').select2({
        width: '100%',
        placeholder: $('#filterCategory').data('placeholder')
    });

    $('#filterLocation').select2({
        width: '100%',
        placeholder: $('#filterLocation').data('placeholder')
    });

    //TODO: FIX OPT HEADER
    $('.jobFilter').on('select2:open select2:unselecting', function(event) {        
        if ($(this).select2('data').length > 0) {            
            //$('.select2-results__group').css({"display":"block !important"});            
        } else {
            //$('.select2-results__group').css({"display":"none !important"});            
        }
        //console.log($(this).select2('data').length);
        //console.log($('.select2-results__group').text());        
    });

    $('.jobFilter').on('change select2:unselecting', function(event) {        
        searchPositions();
    });

    $('.select2').on('select2:opening select2:closing', function( event ) {
        var $searchfield = $(this).parent().find('.select2-search__field');
        $searchfield.prop('disabled', true);
    });
});

var positionData;
var filterResult;

function initSearchFilter(){
    $.getJSON( "/api/job-positions", function( data ) {
        positionData  = data;
        filterResult  = positionData.positions;
        console.log(filterResult);
        
        $('#positionResult .counter').text(filterResult.length);
        //changePositionListing(filterResult);
    });
}

function searchPositions() {    
    filterResult = positionData.positions;
    $('#positionResult .counter').text(filterResult.length);

    var catIds = [];
    var locIds = [];
    

    if ($('#filterCategory').select2('data').length > 0) {
        $('#filterCategory').select2('data').forEach(element => {            
            catIds.push(element.id);
        }); 
    }

    if ($('#filterLocation').select2('data').length > 0) {
        $('#filterLocation').select2('data').forEach(selection => {            
            locIds.push(selection.id);
        }); 
    }
    
    if (locIds.length > 0  || catIds.length > 0) {
        
        filterResult = [];
        positionData.positions.forEach(pos => {
            fitSelection = true;
            if (catIds.length > 0) {                
                if ($.inArray(pos.cat,catIds) === -1) fitSelection = false;
            }            
            if (locIds.length > 0) {
                if ($.inArray(pos.loc,locIds) === -1) fitSelection = false;
            }
            if (fitSelection) filterResult.push(pos);
        });
    }
    changePositionListing(filterResult);
}

function changePositionListing(data) {

    if (data.length == 0) {
        $('#positionResult').attr('disabled','disabled');
        $('#positionResult').hide().addClass('hidden');
        $('#volna-mista').hide().addClass('hidden');
        
        if ($('#noJobResult').hasClass('hidden')) {
            $('#noJobResult').hide().removeClass('hidden').fadeIn(200);
        }
        initWatchDog(data);
    } else {
        $('#positionResult .counter').text(data.length);
        
        $('#positionResult').removeAttr('disabled');
        
        $('#noJobResult').hide().addClass('hidden');
        $('#hlidaci-pes').hide().addClass('hidden');
        
        if ($('#positionResult').hasClass('hidden')) {
            $('#positionResult').hide().removeClass('hidden').fadeIn(200);
        }
        if ($('#volna-mista').hasClass('hidden')) {
            $('#volna-mista').hide().removeClass('hidden').fadeIn(200);
        }
        $('.filterPositionResult').html('');
        data.forEach(drawPositionItem);

        $('.districtMap').on('mouseover',function(){
            $(this).find('span').show();
            followMouse(this)
        });

        $('.districtMap').on('mouseout',function(){
            $(this).find('span').hide();
        });
    }
}

function initWatchDog(data){    
    if ($('#filterCategory').select2('data').length > 0) {
        $('.watchDog .selectedCategories .selectedItems').removeClass('empty');
        $('.watchDog .selectedCategories .selectedItems').html('');
        $('#filterCategory').select2('data').forEach(selection => {
            $('.watchDog .selectedCategories .selectedItems').append(
                $('<a/>',{href:'#'}).append('<div class="closeIcon"></div>').append(positionData.categories[selection.id])
            );
        });
    } else {
        $('.watchDog .selectedCategories .selectedItems').addClass('empty');
    }
    
    if ($('#filterLocation').select2('data').length > 0) {
        $('.watchDog .selectedLocations .selectedItems').removeClass('empty');
        $('.watchDog .selectedLocations .selectedItems').html('');
        $('#filterLocation').select2('data').forEach(selection => {            
            $('.watchDog .selectedLocations .selectedItems').append(
                $('<a/>',{href:'#'}).append('<div class="closeIcon"></div>').append(positionData.locations[selection.id])
            );
        });
    } else {
        $('.watchDog .selectedLocations .selectedItems').addClass('empty');
    }
    
    if ($('#hlidaci-pes').hasClass('hidden')) {            
        $('#hlidaci-pes').hide().removeClass('hidden').fadeIn(200);
    }
    
    $('.watchDog').show();
    $('.thankYou').hide();
}

function followMouse(obj){
    $(obj).mousemove(function(event){
        //$(obj).find('span').css('top',event.pageY).css('left',event.pageX);
        //console.log($(obj).find('span'));
    });
}

function drawPositionItem(item,index,arr) {
    //console.log(index,item);
    var positionLink = $('<a/>',{
        href: item.localLink,
        text: item.name
    });
    var posItem = $('<tr/>').append(
        $('<td/>',{class:'positionLink'}).append(positionLink)
    ).append(
        $('<td/>',{class:'location districtMap '+item.regionMap}).append('<span>'+item.regionTitle+'</span>')
    ).append(
        $('<td/>',{class:'date'}).append('<span>'+item.dateAdded+'</span>')
    ).append(
        $('<td/>',{class:'date deadline'}).append('<span>'+item.dateExpire+'</span>')
    );
    $('.filterPositionResult').append(posItem);
}