import * as THREE from 'three';
import { OrbitControls } from 'node_modules/three/examples/jsm/controls/OrbitControls'
import {ElementRef, Injectable, NgZone, OnDestroy} from '@angular/core';
import { Vector } from 'three';

@Injectable({providedIn: 'root'})
export class EngineService implements OnDestroy {
  private canvas: HTMLCanvasElement;
  private renderer: THREE.WebGLRenderer;
  private camera: THREE.PerspectiveCamera;
  private scene: THREE.Scene;
  private light: THREE.AmbientLight;
  private controls: OrbitControls;
  private cube: THREE.Mesh;

  private frameId: number = null;

  public constructor(private ngZone: NgZone) {
  }

  public ngOnDestroy(): void {
    if (this.frameId != null) {
      cancelAnimationFrame(this.frameId);
    }
  }

  public createScene(canvas: ElementRef<HTMLCanvasElement>): void {
    // The first step is to get the reference of the canvas element from our HTML document
    this.canvas = canvas.nativeElement;

    this.renderer = new THREE.WebGLRenderer({
      canvas: this.canvas,
      alpha: true,    // transparent background
      antialias: true // smooth edges
    });
    this.renderer.setSize(window.innerWidth, window.innerHeight);
    
    // create the scene
    this.scene = new THREE.Scene();

    this.camera = new THREE.PerspectiveCamera(
      60, window.innerWidth / window.innerHeight, 50, 500
    );
    this.camera.position.set(0,5,100);
    this.scene.add(this.camera);

    this.controls = new OrbitControls(this.camera, this.canvas);
    // soft white light
    this.light = new THREE.AmbientLight(0x0000ff);
    this.light.position.set(5,5,5);
    this.scene.add(this.light);
    this.light = new THREE.AmbientLight(0x0000ff);
    this.light.position.set(10,10,10);

    this.scene.add(this.light);

    const geometry = new THREE.SphereGeometry(7, 20, 20 );
    const material = new THREE.MeshMatcapMaterial( {color: 'red'} );
    this.cube = new THREE.Mesh(geometry, material);
    this.scene.add(this.cube);
    
    const geometry_2 = new THREE.SphereGeometry(7, 20, 20 );
    const material_2 = new THREE.MeshToonMaterial({color:0xff4444})
    this.cube = new THREE.Mesh(geometry_2, material_2);
    this.cube.position.set(10,20,10)
    this.scene.add(this.cube);

    const material_3 = new THREE.MeshBasicMaterial({
      color: 'white',
      side: 10
    });

    const points = [];
    points.push( new THREE.Vector3( 0, 0, 0 ) );
    points.push( new THREE.Vector3( 10, 20, 10 ) );
    //points.push( new THREE.Vector3( 10, 0, 0 ) );

    //const geometry_3 = new THREE.BufferGeometry().setFromPoints( points );
    const geometry_3 = new THREE.TubeGeometry(
      new THREE.CatmullRomCurve3(points),
      512,// path segments
      0.8,// THICKNESS
      8, //Roundness of Tube
      false //closed
    );


    const line = new THREE.Line( geometry_3, material_3 );
    this.scene.add( line );
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
    /* this.controls.update();
    this.cube.rotation.x += 0.1;
    this.cube.rotation.y += 0.1; */
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
