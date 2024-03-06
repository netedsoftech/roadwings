$(document).ready(function(){

    var canvas,ctx,points = [];
    
    
    canvas = $("#canvas")[0];
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    ctx = canvas.getContext('2d');
    
    $('#canvas').mousemove(function (event){
    
        var Distance,dx,dy, max = 150;
        var point0, point1;
        point0 = {x:event.pageX - this.offsetLeft,y:event.pageY - this.offsetTop};
        ctx.strokeStyle="rgba(255, 255, 255,0.2)";
        for( i = 0;i<points.length;i++)
        {
        point1 = points[i];
        dx = point1.x-point0.x;
        dy = point1.y-point0.y;
        Distance = Math.sqrt(dx*dx + dy*dy);
            if(Distance<max)
            {
                ctx.beginPath();
                ctx.lineWidth = 1 - Distance/max;
                ctx.moveTo(point0.x,point0.y);
                ctx.lineTo(point1.x,point1.y);
                ctx.stroke();
            }
        }
        points.push(point0);
        
    
        
    });
    
    });	