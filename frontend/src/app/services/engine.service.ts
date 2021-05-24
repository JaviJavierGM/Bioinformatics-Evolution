import * as THREE from 'three';
import { OrbitControls } from 'node_modules/three/examples/jsm/controls/OrbitControls'
import {ElementRef, Injectable, NgZone, OnDestroy} from '@angular/core';



class Conformation {
  posX: number;
  posY: number;
  posZ: number;
  vectorMov: number[];
  letter: string;
  constructor(X:number,Y:number,Z:number,vectorMov: number[],letter: string){
    this.posX=X;
    this.posY=Y;
    this.posZ=Z;
    this.vectorMov=vectorMov;
    this.letter=letter;
  }
}


@Injectable({providedIn: 'root'})
export class EngineService implements OnDestroy {
  public canvas: HTMLCanvasElement;
  private renderer: THREE.WebGLRenderer;
  private camera: THREE.PerspectiveCamera;
  private scene: THREE.Scene;
  private light: THREE.AmbientLight;
  private controls: OrbitControls;
  private cube: THREE.Mesh;
  private arrayAmi: Array<Conformation>;
  private posXCam: number;
  private posYCam: number;
  private posZCam: number;

  private frameId: number = null;
  
  public constructor(private ngZone: NgZone) {
    this.arrayAmi = new Array(new Conformation(-10,0,0,[1,0],'H'));
    this.arrayAmi.push(new Conformation(0,0,0,[1,0],'H'));
    this.arrayAmi.push(new Conformation(0,10,0,[1,0],'P'));
    this.arrayAmi.push(new Conformation(10,10,0,[1,0],'H'));
    this.arrayAmi.push(new Conformation(10,20,0,[1,0],'P'));
    this.arrayAmi.push(new Conformation(20,20,0,[1,0],'H'));
    
  }

  public ngOnDestroy(): void {
    if (this.frameId != null) {
      cancelAnimationFrame(this.frameId);
    }

  }

  public createScene(canvas: ElementRef<HTMLCanvasElement>,  array_C: any): void {
    

    this.canvas = canvas.nativeElement;


    this.renderer = new THREE.WebGLRenderer({
      canvas: this.canvas,
      alpha: true,    // transparent background
      antialias: true, // smooth edges
      preserveDrawingBuffer: true
    });
    this.renderer.setSize(window.innerWidth, window.innerHeight);
    
    // create the scene
    this.scene = new THREE.Scene();

    this.camera = new THREE.PerspectiveCamera(
      80, window.innerWidth / window.innerHeight, 1, 500
    );

    let middleCam=Math.round(array_C.points.length/2); 
    
    
    
    this.posXCam=array_C.points[middleCam].xValue*6;
    this.posYCam=array_C.points[middleCam].yValue*6;
    this.posZCam=0;

    this.camera.position.set(this.posXCam,this.posYCam,100);
    
    

    
    this.scene.add(this.camera);

    
   
      //Agrega luces
    for (var index = 0; index < array_C.points.length; index++) {
      this.light = new THREE.AmbientLight(0x0000ff);
      this.light.position.set(array_C.points[index].xValue*6, array_C.points[index].yValue*6,array_C.points[index].zValue*6);
      this.scene.add(this.light);
      
    }

    

    //Material para H o P
    const material = new THREE.MeshMatcapMaterial( {color: 'red'} );
    const material_2 = new THREE.MeshToonMaterial({color:0xff4444})
    
    //Agrega esferas

    for (var index = 0; index < array_C.points.length; index++) {
      
      const geometry = new THREE.SphereGeometry(2, 20, 20 );
      if (array_C.points[index].letter.localeCompare('H')) {
        this.cube = new THREE.Mesh(geometry, material);
        this.cube.position.set(array_C.points[index].xValue*6, array_C.points[index].yValue*6,array_C.points[index].zValue*6);
      }else{
        this.cube = new THREE.Mesh(geometry, material_2);
        this.cube.position.set(array_C.points[index].xValue*6, array_C.points[index].yValue*6,array_C.points[index].zValue*6);
      }
      this.scene.add(this.cube);
    } 
     


    // Añade enlaces


    

    for(var conta=0; conta<array_C.points.length-1;conta++ ){

      const points = []

      for (var index = 0; index < 2; index++) {
        points.push(new THREE.Vector3(array_C.points[conta+index].xValue*6, array_C.points[conta+index].yValue*6,array_C.points[conta+index].zValue*6));

      }
      
      var pathBase = new THREE.CatmullRomCurve3(points);
      var tgeometry = new THREE.TubeGeometry( pathBase,1, .5, 20, false );
      var tmaterial = new THREE.MeshBasicMaterial( { color: 0xCCCCCC } );
      var tmesh = new THREE.Mesh( tgeometry, tmaterial );
      this.scene.add(tmesh);
    }
    
    this.controls = new OrbitControls(this.camera, this.canvas);
    this.controls.target= new THREE.Vector3(this.posXCam,this.posYCam,0);
    this.camera.lookAt(this.posXCam,this.posYCam,1);
    
    this.controls.enableKeys = true;
    this.controls.enableRotate = false;
    this.controls.autoRotate=false;
    
    /*
    this.controls.mouseButtons = {
      LEFT: THREE.MOUSE.ROTATE,
      MIDDLE: THREE.MOUSE.DOLLY,
      RIGHT: THREE.MOUSE.PAN
    }
     */
    
    
    
  }

  public animate(): void {
    // We have to run this outside angular zones,
    // because it could trigger heavy changeDetection cycles.
    this.ngZone.runOutsideAngular(() => {
      if (document.readyState !== 'loading') {
        this.render();
      } else {
        window.addEventListener('DOMContentLoaded', () => {
          this.render();
        });
      }

      window.addEventListener('resize', () => {
        this.resize();
      });
    });
  }

  public render(): void {
    
    this.frameId = requestAnimationFrame(() => {
      
      this.render();
    });
    
    
    this.controls.update()
    this.renderer.render(this.scene, this.camera);
   
  }

  public resize(): void {
    const width = window.innerWidth;
    const height = window.innerHeight;

    this.camera.aspect = width / height;
    this.camera.updateProjectionMatrix();

    this.renderer.setSize(width, height);
  }
}
