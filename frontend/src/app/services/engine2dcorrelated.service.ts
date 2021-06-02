import * as THREE from 'three';
import { OrbitControls } from 'node_modules/three/examples/jsm/controls/OrbitControls'
import {ElementRef, Injectable, NgZone, OnDestroy} from '@angular/core';
import { createTrue } from 'typescript';

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

class axisTocube {
  posX: number;
  posY: number;
  posZ: number;
  value: boolean;
  constructor(X:number,Y:number,Z:number,value: boolean){
    this.posX=X;
    this.posY=Y;
    this.posZ=Z;
    this.value=value;
  }
}



@Injectable({providedIn: 'root'})
export class Engine2DCorrelatedService implements OnDestroy {
  public canvas: HTMLCanvasElement;
  private renderer: THREE.WebGLRenderer;
  private camera: THREE.OrthographicCamera;
  private camera_dos: THREE.PerspectiveCamera;
  private helper: THREE.CameraHelper;
  private scene: THREE.Scene;
  private light: THREE.AmbientLight;
  private controls: OrbitControls;
  private cube: THREE.Mesh;

  private posXCam: number;
  private posYCam: number;
  private posZCam: number;

  private frameId: number = null;
  
  public constructor(private ngZone: NgZone) {
   
    
  }

  public ngOnDestroy(): void {
    if (this.frameId != null) {
      cancelAnimationFrame(this.frameId);
    }

  }

  
  public createScene(canvas: ElementRef<HTMLCanvasElement>,array_C: any,arrayCubes: Array<axisTocube>): void {

    
    // The first step is to get the reference of the canvas element from our HTML document
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
    this.scene.background = new THREE.Color("rgb(255, 255, 255)")

    /* this.camera = new THREE.PerspectiveCamera(
      90, window.innerWidth / window.innerHeight, 1, 1000
    );
 */
    this.camera =  new THREE.OrthographicCamera( window.innerWidth / - 40, window.innerWidth / 40,  window.innerHeight / 40,  window.innerHeight / - 40, 5, 50
      );
    let middleCam=Math.round(  array_C.points.length/2); 
   
   
    this.posXCam=array_C.points[middleCam].xValue*6;
    this.posYCam=array_C.points[middleCam].yValue*6;

    this.camera.position.set(this.posYCam ,this.posXCam*-1,10);

    this.scene.add(this.camera);
    
    
    
    
     // soft white light
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
          
        }else{
          this.cube = new THREE.Mesh(geometry, material_2);
         // this.cube.position.set(array_C.points[index].xValue*6, array_C.points[index].yValue*-6,array_C.points[index].zValue*6);
        }
        this.cube.position.set(array_C.points[index].yValue*6, array_C.points[index].xValue*-6,array_C.points[index].zValue*6);
        this.scene.add(this.cube);
      } 
       

    //Add union

    for(var conta=0; conta<array_C.points.length-1;conta++ ){

      const points = []

      for (var index = 0; index < 2; index++) {
        points.push(new THREE.Vector3(array_C.points[conta+index].yValue*6, array_C.points[conta+index].xValue*-6,array_C.points[conta+index].zValue*6));

      }
      
      var pathBase = new THREE.CatmullRomCurve3(points);
      var tgeometry = new THREE.TubeGeometry( pathBase, array_C.points.length-1, .8, 20, false );
      var tmaterial = new THREE.MeshBasicMaterial( { color: 0xCCCCCC } );
      var tmesh = new THREE.Mesh( tgeometry, tmaterial );
      this.scene.add(tmesh);
    }

    //Add mesh

    const material_3 = new THREE.MeshMatcapMaterial( {color: '#141a1f'} ); // black
    const material_4 = new THREE.MeshMatcapMaterial( {color: '#d9d9d9'} ); ///gray


    for (var index = 0; index < arrayCubes.length; index++) {
      
      const geometry = new THREE.SphereGeometry(1.8, 20, 20 );
      if (arrayCubes[index].value==false) {
        this.cube = new THREE.Mesh(geometry, material_3);
        this.cube.position.set(arrayCubes[index].posX , arrayCubes[index].posY,arrayCubes[index].posZ);
      
        this.scene.add(this.cube);
      }else{
        this.cube = new THREE.Mesh(geometry, material_4);
        this.cube.position.set(arrayCubes[index].posX , arrayCubes[index].posY,arrayCubes[index].posZ);
      
        this.scene.add(this.cube);

      }
      
    } 


    this.controls = new OrbitControls(this.camera, this.canvas);
    this.controls.target.set(this.posYCam ,this.posXCam*-1,0) 
    
    this.camera.lookAt(this.posYCam ,this.posXCam*-1,0);
    
    this.controls.enableKeys = true;
    this.controls.enableRotate = false;
    this.controls.autoRotate=false;
    
   
    
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
    
    this.controls.update();
    
    this.renderer.render(this.scene, this.camera);
  }

  public resize(): void {
    const width = window.innerWidth;
    const height = window.innerHeight;
    this.controls.update();
    //this.camera.aspect = width / height;
    this.camera.updateProjectionMatrix();

    this.renderer.setSize(width, height);
  }
}