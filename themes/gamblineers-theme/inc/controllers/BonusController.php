<?php
// TODO: move this stuff to separate namespace where you could also omit Bonus prefix.

// http://localhost/testing/
// http://localhost/wp-admin/post.php?post=41180&action=edit
// http://localhost/wp-admin/post.php?post=39594&action=edit
// https://docs.google.com/spreadsheets/d/1BWmDkrLmRsIuribozC5nC9CqkHVANXhlOrkft4x53XM/edit#gid=1624877069

interface IBonusController
{
    public static function list(BonusListRequest $req): BonusCollection;
    public static function listForCasino(BonusListForCasino $req): BonusCollection;
    public static function listForCasino_review(BonusListForCasino $req): BonusCollection;
}

class BonusListForCasino
{
    public string $orderBy;
    public string $metaKeyToOrderBy;
    public int $rec_per_page;
    public int $offset;
    public int $casinoID;

    public function __construct(
        int $casinoID,
        string $orderBy = BonusListOrderBy::ID,
        string $metaKeyToOrderBy = "",
        int $rec_per_page = 0,
        int $offset = 2
    ) {
        $this->orderBy = $orderBy;
        $this->metaKeyToOrderBy = $metaKeyToOrderBy;
        $this->rec_per_page = $rec_per_page;
        $this->offset = $offset;
        $this->casinoID = $casinoID;
    }
}

class BonusListRequest
{
    public string $orderBy;
    public string $metaKeyToOrderBy;
    public int $rec_per_page;
    public int $offset;

    public function __construct(
        int $offset,
        int $rec_per_page,
        string $orderBy = BonusListOrderBy::ID,
        string $metaKeyToOrderBy = ""
    ) {
        $this->orderBy = $orderBy;
        $this->metaKeyToOrderBy = $metaKeyToOrderBy;
        $this->rec_per_page = $rec_per_page;
        $this->offset = $offset;
    }
}

class BonusController implements IBonusController
{
    public static function list(BonusListRequest $req): BonusCollection
    {
        $sql = "
            SELECT 
                a.id, 
                a.casino_id, 
                a.name, 
                a.type, 
                a.crypto_short_description, 
                a.wagering, 
                a.code, 
                a.badges, 
                a.show_in 
            FROM g_bonuses a
            JOIN wp_posts b ON a.casino_id=b.id
            WHERE b.post_status IN ('publish', 'private')
        ";

        switch ($req->orderBy) {
            case BonusListOrderBy::MetaKey:
                $sql = "
                    SELECT 
                        gb.id as id, 
                        gb.casino_id, 
                        gb.name, 
                        gb.type, 
                        gb.crypto_short_description, 
                        gb.wagering, 
                        gb.code, 
                        gb.badges, 
                        0 show_in 
                    FROM g_bonuses gb
                    INNER JOIN g_bonusmeta gbm ON gb.id = gbm.bonus_id
                    INNER JOIN wp_posts c ON gb.casino_id=c.id
                    WHERE gbm.meta_key = '$req->metaKeyToOrderBy'
                    AND c.post_status IN ('publish', 'private') 
                    ORDER BY CAST(gbm.meta_value AS DECIMAL)
                ";
                
                break;
            default:
                $sql .= " ORDER BY id";
                break;
        }
		$sql .= self::addLimit($req->offset, $req->rec_per_page);
        return self::select($sql);
    }

    public static function listForCasino(BonusListForCasino $req): BonusCollection
    {
        $sql = "
        SELECT 
            a.id, 
            a.casino_id, 
            a.type, 
            a.name, 
            a.crypto_short_description, 
            a.wagering, 
            a.code, 
            a.badges, 
            a.show_in 
        FROM g_bonuses a
        JOIN wp_posts b ON a.casino_id=b.id
        WHERE casino_id = $req->casinoID and show_in=0 AND
        b.post_status IN ('publish', 'private')
        ";

        switch ($req->orderBy) {
            case BonusListOrderBy::MetaKey:
                $sql = "
                    SELECT 
                        gb.id as id, 
                        gb.casino_id, 
                        gb.name, 
                        gb.type, 
                        gb.crypto_short_description, 
                        gb.wagering, 
                        gb.code, 
                        gb.badges, 
                        0 show_in 
                    FROM g_bonuses gb
                    INNER JOIN g_bonusmeta gbm ON gb.id = gbm.bonus_id
                    INNER JOIN wp_posts c ON gb.casino_id=c.id
                    WHERE gbm.meta_key = '$req->metaKeyToOrderBy'
                    AND gb.casino_id = $req->casinoID
                    AND c.post_status IN ('publish', 'private')
                    ORDER BY CAST(gbm.meta_value AS DECIMAL)
                ";
                break;
            default:
                $sql .= " ORDER BY id";
                break;
        }
		$sql .= self::addLimit($req->offset, $req->rec_per_page);
        return self::select($sql);
    }
    
    
    
    
    public static function manually_selected(BonusListRequest $req): BonusCollection
    {
        $sql = "
        SELECT 
            a.id, 
            a.casino_id, 
            a.type, 
            a.name, 
            a.crypto_short_description, 
            a.wagering, 
            a.code, 
            a.badges, 
            a.show_in 
        FROM g_bonuses a
        JOIN wp_posts b ON a.casino_id=b.id
        WHERE casino_id in ($req->metaKeyToOrderBy) and show_in=0 AND
        b.post_status IN ('publish', 'private')
        GROUP BY a.casino_id
        ORDER BY FIELD(casino_id, $req->metaKeyToOrderBy)
        ";
        
		$sql .= self::addLimit($req->offset, $req->rec_per_page);
        return self::select($sql);
    }
    
    

    public static function listForCasino_review(BonusListForCasino $req): BonusCollection
    {
        $sql = "
        SELECT 
            a.id, 
            a.casino_id, 
            a.type, 
            a.name, 
            a.crypto_short_description, 
            a.wagering, 
            a.code, 
            a.badges, 
            a.show_in 
        FROM g_bonuses a
        JOIN wp_posts b ON a.casino_id=b.id
        WHERE casino_id = $req->casinoID AND sequence!='-1' AND
        b.post_status IN ('publish', 'private')
        ";

        switch ($req->orderBy) {
            case BonusListOrderBy::MetaKey:
                $sql = "
                    SELECT 
                        gb.id as id, 
                        gb.casino_id, 
                        gb.name, 
                        gb.type, 
                        gb.crypto_short_description, 
                        gb.wagering, 
                        gb.code, 
                        gb.badges, 
                        0 show_in 
                    FROM g_bonuses gb
                    INNER JOIN g_bonusmeta gbm ON gb.id = gbm.bonus_id
                    INNER JOIN wp_posts c ON gb.casino_id=c.id
                    WHERE gbm.meta_key = '$req->metaKeyToOrderBy'
                    AND gb.casino_id = $req->casinoID
                    AND c.post_status IN ('publish', 'private')
                    ORDER BY CAST(gbm.meta_value AS DECIMAL)
                ";
                break;
            default:
                $sql .= " ORDER BY sequence";
                break;
        }
		$sql .= self::addLimit($req->offset, $req->rec_per_page);
        return self::select($sql);
    }

    private static function addLimit(int $offset, int $rec_per_page): string
    {
        if ($rec_per_page > 0) {
            return " LIMIT $offset, $rec_per_page";
        }
        return "";
    }

    private static function select($sql): BonusCollection
    {
        global $wpdb;

        $sqlRes = $wpdb->get_results($sql);

        $bonuses = [];
        foreach ($sqlRes as $row) {
            $badges = unserialize($row->badges);
            if (!$badges) {
                $badges = null;
            }
            
            $bonuses[] = new Bonus(
                $row->id,
                $row->casino_id,
                $row->name,
                $row->type,
                $row->crypto_short_description,
                null,
                $row->wagering,
                $row->code,
                $badges,
                $row->show_in
            );
        }

        return new BonusCollection(...$bonuses);
    }
}

final class BonusListOrderBy
{
    public const ID = "id";
    public const MetaKey = "metakey";
}

class Bonus
{
    public int $id;
    public int $casinoID;
    public string $type;
    public string $name;
    public ?string $cryptoShortDescription;
    public ?string $fiatShortDescription;
    public ?string $wagering;
    public ?string $code;
    public ?array $badges;
    public ?bool $showIn;
    public ?string $description;
    public ?int $matchPercent;
    public ?float $fiatBonusValueUSD;
    public ?float $cryptoBonusValueUSD;
    public ?int $freeSpinsNumber;
    public ?int $matchWagering;
    public ?string $wageringOn;
    public ?float $recalculatedWageringOnBonus;
    public ?int $freeSpinsWagering;
    public ?float $minDepositUSD;


    public function __construct(
        int $id,
        int $casinoID,
        string $name,
        string $type,
        string $cryptoShortDescription  = null,
        string $fiatShortDescription = null,
        string $wagering  = null,
        string $code  = null,
        array $badges  = null,
        string $showIn  = null,
        string $description  = null,
        int $matchPercent  = null,
        float $fiatBonusValueUSD  = null,
        float $cryptoBonusValueUSD  = null,
        int $freeSpinsNumber  = null,
        int $matchWagering  = null,
        string $wageringOn  = null,
        float $recalculatedWageringOnBonus  = null,
        int $freeSpinsWagering  = null,
        float $minDepositUSD = null
    ) {
        $this->id = $id;
        $this->casinoID = $casinoID;
        $this->type = $type;
        $this->name = $name;
        $this->cryptoShortDescription = $cryptoShortDescription;
        $this->fiatShortDescription = $fiatShortDescription;
        $this->wagering = $wagering;
        $this->code = $code;
        $this->badges = $badges;
    
        $this->showIn = false;
        if ($showIn == "1") {
            $this->showIn = true;
        }

        $this->description = $description;
        $this->matchPercent = $matchPercent;
        $this->fiatBonusValueUSD = $fiatBonusValueUSD;
        $this->cryptoBonusValueUSD = $cryptoBonusValueUSD;
        $this->freeSpinsNumber = $freeSpinsNumber;
        $this->matchWagering = $matchWagering;
        $this->wageringOn = $wageringOn;
        $this->recalculatedWageringOnBonus = $recalculatedWageringOnBonus;
        $this->freeSpinsWagering = $freeSpinsWagering;
        $this->minDepositUSD = $minDepositUSD;
    }

    public function getInsertStatement($table = "tmp_g_bonuses"): string
    {
        $badges = null;
        if ($this->badges) {
            $badges = serialize($this->badges);
        }

        $showIn = 0;
        if ($this->showIn) {
            $showIn = 1;
        }

        return "
            INSERT INTO $table (
                id,
                casino_id, 
                name, 
                type, 
                crypto_short_description,
                fiat_short_description, 
                wagering, 
                code, 
                badges, 
                show_in, 
                description, 
                match_percent, 
                fiat_bonus_value_usd, 
                crypto_bonus_value_usd, 
                free_spins_number, 
                match_wagering, 
                wagering_on, 
                recalculated_wagering_on_bonus, 
                free_spins_wagering, 
                min_deposit_usd
            ) VALUES (
                $this->id,
                $this->casinoID,
                '$this->name',
                '$this->type',
                '$this->cryptoShortDescription',
                '$this->fiatShortDescription',
                '$this->wagering',
                '$this->code',
                '$badges',
                $showIn,
                '$this->description',
                $this->matchPercent,
                $this->fiatBonusValueUSD,
                $this->cryptoBonusValueUSD,
                $this->freeSpinsNumber,
                $this->matchWagering,
                '$this->wageringOn',
                $this->recalculatedWageringOnBonus,
                $this->freeSpinsWagering,
                $this->minDepositUSD
            )
        ";
    }

    public function getUpdateFunction($table = "tmp_g_bonuses"): string
    {
        $badges = null;
        if ($this->badges) {
            $badges = serialize($this->badges);
        }

        $showIn = 0;
        if ($this->showIn) {
            $showIn = 1;
        }

        return "
            UPDATE $table SET
                casino_id = $this->casinoID,
                name = '$this->name',
                type = '$this->type',
                crypto_short_description = '$this->cryptoShortDescription',
                fiat_short_description = '$this->fiatShortDescription',
                wagering = '$this->wagering',
                code = '$this->code',
                badges = '$badges',
                show_in = $showIn,
                description = '$this->description',
                match_percent = $this->matchPercent,
                fiat_bonus_value_usd = $this->fiatBonusValueUSD,
                crypto_bonus_value_usd = $this->cryptoBonusValueUSD,
                free_spins_number = $this->freeSpinsNumber,
                match_wagering = $this->matchWagering,
                wagering_on = '$this->wageringOn',
                recalculated_wagering_on_bonus = $this->recalculatedWageringOnBonus,
                free_spins_wagering = $this->freeSpinsWagering,
                min_deposit_usd = $this->minDepositUSD
            WHERE id = $this->id;
        ";
    }
}

final class BonusCollection implements ArrayAccess, IteratorAggregate
{

    private array $bonuses;

    public function __construct(Bonus ...$bonuses)
    {
        $this->bonuses = $bonuses;
    }

    public static function empty(): self
    {
        return new self();
    }

    public function offsetExists($offset): bool
    {
        return isset($this->bonuses[$offset]);
    }

    public function offsetGet($offset): Bonus
    {
        return $this->bonuses[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if ($value instanceof Bonus) {
            $this->bonuses[$offset] = $value;
        } else throw new TypeError("Not a bonus!");
    }

    public function offsetUnset($offset): void
    {
        unset($this->bonuses[$offset]);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->bonuses);
    }
}

class BonusMeta
{
    public int $bonusID;
    public string $key;
    public ?string $value;

    public function __construct(
        int $bonusID,
        string $key,
        string $value
    ) {
        $this->bonusID = $bonusID;
        $this->key = $key;
        $this->value = $value;
    }

    public function getInsertStatement($table = "tmp_g_bonusmeta"): string
    {
        return "
            INSERT INTO $table (
                bonus_id, 
                meta_key, 
                meta_value
            ) VALUES (
                $this->bonusID, 
                '$this->key', 
                '$this->value'
            );
        ";
    }

    public function getUpdateFunction($table = "tmp_g_bonusmeta"): string
    {
        return "
            UPDATE $table SET
                bonus_id = $this->bonusID, 
                meta_value = '$this->value'
            WHERE meta_key = $this->key;
        ";
    }
}