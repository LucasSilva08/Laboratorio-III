namespace Ajax{
    
    let xhttp : XMLHttpRequest = new XMLHttpRequest();

    export function MostrarListado():void{
        //Por GET dentro de la direccion pongo los valores
        xhttp.open("GET","BACKEND/nexo_poo.php?accion=listar",true);
        //al ser una peticion por GET adentro del send va vacio
        xhttp.send()
       
        xhttp.onreadystatechange = () =>{
            if(xhttp.readyState==4 && xhttp.status ==200){
                (<HTMLDivElement>document.getElementById("div_listado")).innerHTML = xhttp.responseText;
            }
        };

    }

    export function Verificar():void{
        xhttp.open("POST","BACKEND/nexo_poo.php",true);
        let legajo:string = (<HTMLInputElement>document.getElementById("legajo_v")).value;
        let form :FormData = new FormData();
        
        form.append('accion','verificar');
        form.append('legajo',legajo);        
        xhttp.send(form);

        xhttp.onreadystatechange = () =>{
            if(xhttp.readyState==4 && xhttp.status ==200){
                alert(xhttp.responseText);
            }
        };      
    }

    export function Agregar(): void{
        xhttp.open("POST","BACKEND/nexo_poo.php",true);
        let form :FormData = new FormData();
        let legajo:string = (<HTMLInputElement>document.getElementById("legajo")).value;
        let apellido:string = (<HTMLInputElement>document.getElementById("apellido")).value;
        let nombre:string = (<HTMLInputElement>document.getElementById("nombre")).value;

        form.append('accion','agregar');
        form.append('legajo',legajo);
        form.append('apellido',apellido);
        form.append('nombre',nombre);

        xhttp.send(form);

        xhttp.onreadystatechange = () =>{
            if(xhttp.readyState==4 && xhttp.status ==200){
                alert(xhttp.responseText);
                MostrarListado();
            }
        };
    }

    export function Modificar():void{
        xhttp.open("POST","BACKEND/nexo_poo.php",true);
        let form :FormData = new FormData();
        let legajo:string = (<HTMLInputElement>document.getElementById("legajo_m")).value;
        let apellido:string = (<HTMLInputElement>document.getElementById("apellido_m")).value;
        let nombre:string = (<HTMLInputElement>document.getElementById("nombre_m")).value;

        form.append('accion','modificar');
        form.append('legajo',legajo);
        form.append('apellido',apellido);
        form.append('nombre',nombre);

        xhttp.send(form);

        xhttp.onreadystatechange = () =>{
            if(xhttp.readyState==4 && xhttp.status ==200){
                alert(xhttp.responseText);
                MostrarListado();
            }
        };
    }

    export function Borrar():void{
        xhttp.open("POST","BACKEND/nexo_poo.php",true);
        let legajo:string = (<HTMLInputElement>document.getElementById("legajo_b")).value;
        let form :FormData = new FormData();
        
        form.append('accion','borrar');
        form.append('legajo',legajo);        
        xhttp.send(form);

        xhttp.onreadystatechange = () =>{
            if(xhttp.readyState==4 && xhttp.status ==200){
                alert(xhttp.responseText);
                MostrarListado();
            }
        };  
    }
    
    
    
    
}