import 'phaser';
export default class ScoreSingleton {
    private static instance: ScoreSingleton;

    private _score: number = 0;
    private _txt: Phaser.GameObjects.Text;

    constructor(scene?: Phaser.Scene) {
        if(!scene) return;

        this._txt = scene.add.text(16, 16, `Набрано очков: ${this._score}`, { fontSize: '32px', color: 'white' }).setDepth(1);
    }

    // STATIC METHODS
    
    /**
     * Standart singleton method, that returns instance
     * @returns ScoreSingleton
     */
    public static getInstance(scene?: Phaser.Scene): ScoreSingleton {
        if(!ScoreSingleton.instance) {
            ScoreSingleton.instance = new ScoreSingleton(scene);
        }

        return ScoreSingleton.instance;
    }
    
    public updateScore(value: number) {
        this._score += value;
        
        if(this._txt) {
            this._txt.text = `Набрано очков: ${this._score}`;
        }
    }

    // SETTERS / GETTERS

    /**
     * @param  {number} val Set score
     */
    set score(val:number) {
        this._score += val;

        if(this._score < 0) {
            this._score = 0;
        }
    }

    /**
     * @returns number Get score
     */
    get score(): number {
        return this.score;
    }
}