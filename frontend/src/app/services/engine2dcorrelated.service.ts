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
  private camera: THREE.PerspectiveCamera;
  private camera_dos: THREE.PerspectiveCamera;
  private helper: THREE.CameraHelper;
  private scene: THREE.Scene;
  private light: THREE.AmbientLight;
  private controls: OrbitControls;
  private cube: THREE.Mesh;
  private arrayAmi: Array<Conformation>;
  private arrayMesh: Array<Conformation>;
  private posXCam: number;
  private posYCam: number;
  private posZCam: number;

  private frameId: number = null;
  
  public constructor(private ngZone: NgZone) {
    this.arrayAmi = new Array(new Conformation((498+10)*6,433*6,0,[1,0],'H'));
    this.arrayAmi.push(new Conformation((498+10)*6,434*6,0,[1,0],'P'));
    this.arrayAmi.push(new Conformation((497+10)*6,434*6,0,[1,0],'H'));
    this.arrayAmi.push(new Conformation((497+10)*6,433*6,0,[1,0],'P'));
    this.arrayAmi.push(new Conformation((497+10)*6,432*6,0,[1,0],'H'));
    this.arrayAmi.push(new Conformation((497+10)*6,431*6,0,[1,0],'H'));


    this.arrayMesh = new Array(new Conformation(7*6,28*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(7*6,29*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(6*6,29*6,0,[1,0],'P'));
    this.arrayMesh.push(new Conformation(6*6,28*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(6*6,27*6,0,[1,0],'P'));
    this.arrayMesh.push(new Conformation(6*6,26*6,0,[1,0],'H'));
    
    this.arrayMesh.push(new Conformation(3*6,26*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(3*6,27*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(3*6,28*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(3*6,29*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(2*6,29*6,0,[1,0],'P'));
    this.arrayMesh.push(new Conformation(2*6,28*6,0,[1,0],'H'));
    this.arrayMesh.push(new Conformation(2*6,27*6,0,[1,0],'P'));
    this.arrayMesh.push(new Conformation(2*6,26*6,0,[1,0],'H'));
    
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

    this.camera = new THREE.PerspectiveCamera(
      90, window.innerWidth / window.innerHeight, 1, 1000
    );

    let middleCam=Math.round(  array_C.points.length/2); 
    //this.posXCam=arrayCubes[middleCam].posX ;
    //this.posYCam=arrayCubes[middleCam].posY ;
    //this.posZCam=0;

    //let middleCam_cubes=Math.round( arrayCubes.length/2); 
    this.posXCam=array_C.points[middleCam].xValue*6;
    this.posYCam=array_C.points[middleCam].yValue*6;
/*     this.camera_dos = new THREE.PerspectiveCamera(
      90, window.innerWidth / window.innerHeight, 25, 800
    );

    
    this.camera_dos.position.set(this.posXCam,this.posYCam,50);
    this.helper = new THREE.CameraHelper(this.camera_dos);
    this.scene.add(this.helper);
 */
    this.camera.position.set(this.posXCam ,this.posYCam,100);

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
          this.cube.position.set(array_C.points[index].xValue*6, array_C.points[index].yValue*6,array_C.points[index].zValue*6);
        }else{
          this.cube = new THREE.Mesh(geometry, material_2);
          this.cube.position.set(array_C.points[index].xValue*6, array_C.points[index].yValue*6,array_C.points[index].zValue*6);
        }
        this.scene.add(this.cube);
      } 
       

    //Add ligths
    const points = []
    for (var index = 0; index < array_C.points.length; index++) {
      points.push(new THREE.Vector3(array_C.points[index].xValue*6, array_C.points[index].yValue*6,array_C.points[index].zValue*6));
    }
    var pathBase = new THREE.CatmullRomCurve3(points);
    var tgeometry = new THREE.TubeGeometry( pathBase, array_C.points.length-1, .8, 20, false );
    var tmaterial = new THREE.MeshBasicMaterial( { color: 0xCCCCCC } );
    var tmesh = new THREE.Mesh( tgeometry, tmaterial );
    this.scene.add(tmesh);
     

    //Add mesh

    const material_3 = new THREE.MeshMatcapMaterial( {color: '#141a1f'} );
    const material_4 = new THREE.MeshMatcapMaterial( {color: '#d9d9d9'} );


    for (var index = 0; index < arrayCubes.length; index++) {
      
      const geometry = new THREE.SphereGeometry(1.8, 20, 20 );
      if (arrayCubes[index].value==true) {
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
    this.controls.target.set(this.posXCam ,this.posYCam,0) 
    //= new THREE.Vector3(this.posXCam,this.posYCam,0);
    this.camera.lookAt(this.posXCam ,this.posYCam,0);
    
    this.controls.enableKeys = true;
    this.controls.enableRotate = false;
    this.controls.autoRotate=false;
    
    /*    
     this.controls.mouseButtons = {
      LEFT: THREE.MOUSE.ROTATE,
      MIDDLE: THREE.MOUSE.DOLLY,
      RIGHT: THREE.MOUSE.PAN
    } */


    
    
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
    this.camera.aspect = width / height;
    this.camera.updateProjectionMatrix();

    this.renderer.setSize(width, height);
  }
}