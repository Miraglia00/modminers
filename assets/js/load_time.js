window.onload = function()
{
    if("performance" in window)
    {
        if("timing" in window.performance)
        {
            var a = window.performance.timing.responseEnd - window.performance.timing.navigationStart;
            var b = window.performance.timing.loadEventStart - window.performance.timing.domLoading
            document.getElementById("result").innerHTML = a + b + "ms";
        }
        else
        {
             document.getElementById("result").innerHTML = "Page Timing API not supported";
        }
    }
    else
    {
        document.getElementById("result").innerHTML = "Page Performance API not supported";
    }
}