{{-- <script> --}}
    form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    enableAllSteps: true,
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        // alert("Submitted!");
        form.submit();
    }
});
{{-- </script> --}}