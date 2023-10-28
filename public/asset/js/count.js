       $(document).ready(function() {
        $('.chercher').on('input', function(){
        if ($('.chercher').val().length>=1) {
            $(document).find('.totalResultat').css('display','block')
        }else{
            $('.totalResultat').css('display','none')
        }
    })
    })  
    
