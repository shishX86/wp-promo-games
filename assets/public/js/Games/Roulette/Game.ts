/// <reference path="../../Core/Type/Game.d.ts"/>

import 'phaser';
import IStrategy from '@pubRoot/Core/Interfaces/IStrategy';

export default class Game extends Phaser.Game {
    private _strategy: IStrategy;
    private _config: Phaser.Types.Core.GameConfig;

    constructor(config: Phaser.Types.Core.GameConfig, strategy: IStrategy) {
       super(config);

       this._strategy = strategy;
       this._config = config;
    }

    //GETTERS

    get strategy():IStrategy { 
        return this._strategy;
    }
}