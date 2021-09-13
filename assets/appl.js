
var tfjs_toxicity_classifier = {

    sliders: function (v) {

        var k = -1,
            s = "";

        k += 1;
        s = "#appl .hbar-" + k;
        jQuery(s).css("width", v[k] + "%").attr("aria-valuenow", v[k]);

        k += 1;
        s = "#appl .hbar-" + k;
        jQuery(s).css("width", v[k] + "%").attr("aria-valuenow", v[k]);

        k += 1;
        s = "#appl .hbar-" + k;
        jQuery(s).css("width", v[k] + "%").attr("aria-valuenow", v[k]);

        k += 1;
        s = "#appl .hbar-" + k;
        jQuery(s).css("width", v[k] + "%").attr("aria-valuenow", v[k]);

        k += 1;
        s = "#appl .hbar-" + k;
        jQuery(s).css("width", v[k] + "%").attr("aria-valuenow", v[k]);

        k += 1;
        s = "#appl .hbar-" + k;
        jQuery(s).css("width", v[k] + "%").attr("aria-valuenow", v[k]);

    }

}

jQuery(document).ready(function () {

    jQuery("#appl .cmd_submit").click(function (e) {

        e.preventDefault();

        var bttn = jQuery(this),
            text = jQuery("#appl .inp_text");

        bttn.text("Please wait …");
        bttn.prop("disabled", true);
        text.prop("disabled", true);

        tfjs_toxicity_classifier.sliders([0, 0, 0, 0, 0, 0]);

        toxicity.load(0.5).then(model => {
            model.classify([text.val()]).then(predictions => {

                var i = 0,
                    p = 0,
                    v = [];
                for (i = 0; i < predictions.length; i += 1) {
                    p = 100 * predictions[i].results[0].probabilities[1];
                    v.push(Math.round(p));
                }

                tfjs_toxicity_classifier.sliders(v);

                bttn.text("Submit");
                bttn.prop("disabled", false);
                text.prop("disabled", false);

            });
        });

    });

});
