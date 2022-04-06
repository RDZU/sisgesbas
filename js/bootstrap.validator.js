(function ( $ ) {

    $.fn.validate = function( options ) {

        var settings = $.extend({
            init: function() {},
            success: function() {},
            fail: function(invalids) {}
        }, options );


        return this.on('submit', function(e) {
            var form = this;
            var invalids = [];

            settings.init.call(form);

            var data = {};
            $('input,textarea,select', this).each(function() {
                var i = $(this);
                var name = i.attr('name');
                if(typeof(name) != 'undefined' && (i.is(":not([type='checkbox'],[type='radio'])") || i.is(":checked"))) {
                    var value = i.val();
                    if(typeof(data[name]) != 'undefined') {
                        data[name] += ' ' + value;
                    } else {
                        data[name] = value;
                    }
                }
            });

            $("[data-regex],[data-require],[required],[data-equals]", form).each(function() {
                var self = $(this);
                var regex = self.attr('data-regex');
                var required = self.is('[data-require]') || self.is('[data-required]');
                var equals = self.attr('data-equals');
                var value = self.val();

                if(self.is("[type='checkbox']") && !self.is(":checked")) value='';

                // replace value with total value
                var name = self.attr('name');
                if(typeof(name) != 'undefined') {
                    value = data[name];
                }

                if(typeof(equals) != 'undefined' && typeof(data[equals]) != 'undefined') {
                    if(value != data[equals]) {
                        invalids.push(this);
                        invalids.push($("[name='" + equals + "']")[0]);
                    }
                }

                if(value && value.length > 0) {
                    var r;
                    if(regex == 'name+family') {
                        r = /^((?![0-9]).+\s.+)/g;
                    } else if(regex == 'name' || regex == 'family') {
                        r = /^((?![0-9]).+)/g;
                    } else if(regex == 'email') {
                        r = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    } else if(regex == 'tel') {
                        r = /^[0-9\-\+]{3,25}$/;
                    } else {
                        r = new RegExp(regex);
                    }
                    if(!r.test(value)) {
                        invalids.push(this);
                    }
                } else if(required) {
                    invalids.push(this);
                }
            });

            if(invalids.length > 0) {
                e.preventDefault();
                settings.fail.call(form, invalids, data);
            } else {
                settings.success.call(form, e, data);
            }
        });

    };

    $.fn.bootstrap3Validate = function(success, data) {
        return this.validate({
            'init': function() {
                $('.error', this).removeClass('error').find('input,textarea').tooltip('destroy');
                $('.alert').hide();
                $('[rel=tooltip]', this).tooltip('destroy');
            },
            'success': function(e, data) {
                if (typeof(success) === 'function') {
                    success.call(this, e, data);
                }
            },
            'fail': function(invalids) {
                var form = this;

                $(invalids).closest('.form-group').addClass('error').find('input,select,textarea').each(function(i) {
                    var target = $(this);
                    var text = target.attr('data-title');
                    if(!text) {
                        text = target.attr('placeholder');
                    }

                    if(text) {
                        if(!target.is("[type='checkbox']")) {
                            target.tooltip({'trigger':'focus', placement: 'right', title: text});
                        }

                        if(i == 0) {
                            this.focus();
                        }
                    }
                });
            },
        });
    }

}( jQuery ));
