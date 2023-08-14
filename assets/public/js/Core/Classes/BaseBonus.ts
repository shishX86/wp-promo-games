import 'phaser';

export default class BaseBonus extends Phaser.Physics.Arcade.Sprite {
    private _deltaScore: number;
    private _deltaHealth: number;

    constructor(scene: Phaser.Scene, x: number, y: number, texture: string, frame?: string | number) {
        super(scene, x, y, texture, frame);

        scene.add.existing(this);
        scene.physics.add.existing(this);

        this.on('destroy', this.collect);
    }
    

    // SETTERS / GETTERS
    
    /**
     * Setter for delta score when player collect bonus
     * @param  {number} value of delta score
     */
    set deltaScore(value: number) {
       this._deltaScore = value;
    }

    /**
     * Getter for delta score when player collect bonus
     * @returns number - value of delta score
     */
    get deltaScore(): number {
        return this._deltaScore;
    }

    /**
     * Setter for delta health when player collect bonus
     * @param  {number} value - value of delta health
     */
    set deltaHealth(value: number) {
        this._deltaHealth = value;
    }
    /**
     * Setter for delta health when player collect bonus
     * @returns number - value of delta health
     */
    get deltaHealth(): number {
        return this._deltaHealth;
    }

    /**
     * Returns character physical body
     * @returns Phaser.Physics.Arcade.Body
     */
    get pBody(): Phaser.Physics.Arcade.Body {
        return this.body as Phaser.Physics.Arcade.Body;
    }

    // METHODS
    
    protected collect(): void {        
        console.error(`Method collect must be implemented for ${this.constructor.name}`);
    }

    /**
     * Destroy game object
     * @returns void
     */
    public die(withAnimation?: boolean): void {
        // TODO: Implement this
    }
}