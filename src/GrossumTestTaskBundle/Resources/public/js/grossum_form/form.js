'use strict';
//==================================================================================
//      Validator form START
//==================================================================================
var validate = validate || {};
validate.regularText    = /^[\w\s]+$/;
validate.regularFloat   = /^\d*(\.\d+)?$/;
validate.regularEmail   = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
//
validate.rgxText = function (str) {
    return (str.length > 0) ? validate.regularText.test(str) : false;
};
//
validate.rgxFloat = function (str) {
    return (str.length > 0) ? validate.regularFloat.test(str) : false;
};
//
validate.rgxTextNotEmpty = function (str) {
    return (str.length > 0) ? true : false;
};
//
validate.rgxEmail = function (str) {
    return (str.length > 0) ? validate.regularEmail.test(str) : false;
};

validate.errorVisible = function (cls, textErrorClass, cssErrorClass) {
    cls.addClass('error');
    if (!!textErrorClass) {
        $(textErrorClass).css(cssErrorClass);
    }
};

validate.errorNotVisible = function (cls, textErrorClass, cssErrorClass) {
    cls.removeClass('error');
    if (!!textErrorClass) {
        $(textErrorClass).css(cssErrorClass);
    }
};

validate.validateToType = function(type,value,classError,$this) {
    switch (type) {
        case 'text'     : return !!validate.rgxText(value);break;
        case 'textarea' : return !!validate.rgxText(value);break;
        case 'number'   : return !!validate.rgxFloat(value);break;
        case 'email'    : return !!validate.rgxEmail(value);break;
        case 'hidden'   : return true ;break;
    }
};

validate.removeClass = function( classname, element ) {
    element.classList.remove(classname);
};

validate.addClass = function( classname, element ) {
    element.classList.add(classname);
};
//==================================================================================
//      Validator form END
//==================================================================================
// =================================================================================
//      Form START
//==================================================================================
+function($,validate) {

     $(document).ready(function(){
        var submitForm      = '#contacts_submit',
            resetForm       = '#contacts_reset',
            flashDiv        = {"flash":".alert","success":"alert-success","danger":"alert-danger"},
            errorClassName  = 'has-error';

         $(submitForm).on('click',function(e){
            var validateForm    = true;
            e.stopPropagation();
            e.preventDefault();
            var self = document.querySelector('form');

            for (var i=0; i<self.length; i++){
                if(self[i].type == "fieldset" || self[i].type == "submit" || self[i].type =="undefined") continue;
                if(self[i].hasAttribute('data-validate')) continue;
                if(validate.validateToType(self[i].type, self[i].value, self[i])){
                    validate.removeClass(errorClassName,self[i]);
                } else {
                    validateForm = false;
                    validate.addClass(errorClassName,self[i]);
                }
            }
             if(validateForm)
             {

                 var formUrl    = self.action,
                     formMethod = self.method,
                     formData   = $(self).serialize();

                 $.ajax({
                     url: formUrl,
                     type: formMethod,
                     data: formData,
                     success: function (data) {
                         if (data.code == 200 ) {
                             $(flashDiv.flash).addClass(flashDiv.success).html(data.message).fadeIn(3000);
                             setTimeout(function(){
                                 $(flashDiv.flash).fadeOut(2000).html();
                                 $(flashDiv.flash).removeClass(flashDiv.success)
                             },3000);

                         }
                         if (data.code == 500 ) {
                             $(flashDiv.flash).addClass(flashDiv.danger).html(data.message).fadeIn(3000);
                             setTimeout(function(){
                                 $(flashDiv.flash).fadeOut(2000).html();
                                 $(flashDiv.flash).removeClass(flashDiv.danger)
                             },3000);

                         }

                     },
                     error: function (xhr, ajaxOptions, thrownError) {
                         console.log("Error");
                         console.log(xhr);
                     }

                 });

             }
        });

        $(resetForm).on('click',function(e){
            e.stopPropagation();
            e.preventDefault();
            var self = document.querySelector('form');

            for (var i=0; i<self.length; i++){
                if(self[i].type == "fieldset" || self[i].type == "submit" || self[i].type =="undefined") continue;
                validate.removeClass(errorClassName,self[i]);
                self[i].value   = '';
            }
        });

    });

}(jQuery,validate);
//==================================================================================
//      Form END
//==================================================================================
