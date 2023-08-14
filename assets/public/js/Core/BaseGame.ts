import IStrategy from "@pubCore/Interfaces/IStrategy";
import RouletteStrategy from "@pubGames/Roulette/RouletteStrategy";
import { FieldsConfig } from "@pubCore/Environment/GlobalConfig";
import { GameStrategiesEnum } from "@pubCore/Enums/GameStrategiesEnum";
import FlappyBirdStrategy from "@pubGames/Flappybird/FlappyBirdStrategy";

export default class BaseGame {
    private _data: any;
    private _strategy: IStrategy;
    private _id: number;

    constructor(data: Array<object>, id: number) {
        this._data = data;
        this._id = id;
    }

    /**
     * Initialize gemes services
     */
    public init(): void {
        this.setStrategy();
    }

    /**
     * Set current game strategy
     * 
     * @returns void
     */
    private setStrategy(): void {
        const fieldName: string = FieldsConfig.strategyFieldName;
        const strategyData = this._data[fieldName];
        
        if (!strategyData.value || !strategyData.value.label) return;

        const strategyName = strategyData.value.label;

        switch (strategyName) {
            case GameStrategiesEnum.FLAPPY_BIRD:
                this._strategy = new FlappyBirdStrategy(strategyName);
                break;
            case GameStrategiesEnum.ROULETTE:
                this._strategy = new RouletteStrategy(strategyName);
                break;
            default:
                throw new Error("Can't find strategy");
        }

        if(!this._strategy) return;
        this._strategy.initGame(this._data, this._id);
    }
}