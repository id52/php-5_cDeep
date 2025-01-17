<?
/**
 * Base class for all databases.
 * Can create transactions and new BLOBs, parse DSNs.
 * 
 * Logger is COMMON for multiple transactions.
 * Error handler is private for each transaction and database.
 */
class DbSimple_Generic_Database extends DbSimple_Generic_LastError
{
    /**
     * Public methods.
     */

    /**
     * object blob($blob_id)
     * Create new blob
     */
    public function blob($blob_id = null)
    {
        $this->_resetLastError();
        return $this->_performNewBlob($blob_id);
    }
    
    /**
     * void transaction($mode)
     * Create new transaction.
     */
    public function transaction($mode=null)
    {
        $this->_resetLastError();
        $this->_logQuery('-- START TRANSACTION '.$mode);
        return $this->_performTransaction($mode);
    }

    /**
     * mixed commit()
     * Commit the transaction.
     */
    public function commit()
    {
        $this->_resetLastError();
        $this->_logQuery('-- COMMIT');
        return $this->_performCommit();
    }

    /**
     * mixed rollback()
     * Rollback the transaction.
     */
    public function rollback()
    {
        $this->_resetLastError();
        $this->_logQuery('-- ROLLBACK');
        return $this->_performRollback();
    }

    /**
     * mixed select(string $query [, $arg1] [,$arg2] ...)
     * Execute query and return the result.
     */
    public function select($query)
    {
        $args = func_get_args();
        $total = false;
        return $this->_query($args, $total);
    }
    
    /**
     * mixed selectPage(int &$total, string $query [, $arg1] [,$arg2] ...)
     * Execute query and return the result.
     * Total number of found rows (independent to LIMIT) is returned in $total
     * (in most cases second query is performed to calculate $total).
     */
    public function selectPage(&$total, $query)
    {
        $args = func_get_args();
        array_shift($args);
        $total = true;
        return $this->_query($args, $total);
    }

    /**
     * hash selectRow(string $query [, $arg1] [,$arg2] ...)
     * Return the first row of query result.
     * On errors return null and set last error.
     * If no one row found, return array()! It is useful while debugging,
     * because PHP DOES NOT generates notice on $row['abc'] if $row === null
     * or $row === false (but, if $row is empty array, notice is generated).
     */
    public function selectRow()
    {
        $args = func_get_args();
        $total = false;
        $rows = $this->_query($args, $total);
        if (!is_array($rows)) return $rows;
        if (!count($rows)) return array();
        reset($rows);
        return current($rows);
    }

    /**
     * array selectCol(string $query [, $arg1] [,$arg2] ...)
     * Return the first column of query result as array.
     */
    public function selectCol()
    {
        $args = func_get_args();
        $total = false;
        $rows = $this->_query($args, $total);
        if (!is_array($rows)) return $rows;
        $this->_shrinkLastArrayDimensionCallback($rows);
        return $rows;
    }

    /**
     * scalar selectCell(string $query [, $arg1] [,$arg2] ...)
     * Return the first cell of the first column of query result.
     * If no one row selected, return null.
     */
    public function selectCell()
    {
        $args = func_get_args();
        $total = false;
        $rows = $this->_query($args, $total);
        if (!is_array($rows)) return $rows;
        if (!count($rows)) return null;
        reset($rows);
        $row = current($rows);
        if (!is_array($row)) return $row;
        reset($row);
        return current($row);
    }

    /**
     * mixed query(string $query [, $arg1] [,$arg2] ...)
     * Alias for select(). May be used for INSERT or UPDATE queries.
     */
    public function query()
    {
        $args = func_get_args();
        $total = false;
        return $this->_query($args, $total);
    }
    
    /**
     * string escape(mixed $s, bool $isIdent=false)
     * Enclose the string into database quotes correctly escaping
     * special characters. If $isIdent is true, value quoted as identifier 
     * (e.g.: `value` in MySQL, "value" in Firebird, [value] in MSSQL).
     */
    public function escape($s, $isIdent=false)
    {
        return $this->_performEscape($s, $isIdent);
    }
    

    /**
     * callback setLogger(callback $logger)
     * Set query logger called before each query is executed.
     * Returns previous logger.
     */
    public function setLogger($logger)
    {
        $prev = $this->_logger;
        $this->_logger = $logger;
        return $prev;
    }
    
    /**
     * callback setCacher(callback $cacher)
     * Set cache mechanism called during each query if specified.
     * Returns previous handler.
     */
    public function setCacher($cacher)
    {
        $prev = $this->_cacher;
        $this->_cacher = $cacher;
        return $prev;
    }
    
    /**
     * string setIdentPrefix($prx)
     * Set identifier prefix used for $_ placeholder.
     */
    public function setIdentPrefix($prx)
    {
        $old = $this->_identPrefix;
        if ($prx !== null) $this->_identPrefix = $prx;
        return $old;
    }

    /**
     * string setIdentPrefix($prx)
     * Set cache prefix used in key caclulation.
     */
    public function setCachePrefix($prx)
    {
        $old = $this->_cachePrefix;
        if ($prx !== null) $this->_cachePrefix = $prx;
        return $old;
    }
    
    /**
     * array getStatistics()
     * Returns various statistical information.
     */
    public function getStatistics()
    {
        return $this->_statistics;
    }


    /**
     * Virtual protected methods
     */
    #function ____________PROTECTED() {} // for phpEclipse outline


    /**
     * string _performEscape(mixed $s, bool $isIdent=false)
     */
    protected function _performEscape($s, $isIdent)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * object _performNewBlob($id)
     * 
     * Returns new blob object.
     */
    protected function& _performNewBlob($id)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * list _performGetBlobFieldNames($resultResource)
     * Get list of all BLOB field names in result-set.
     */
    protected function _performGetBlobFieldNames($result)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }
    
    /**
     * mixed _performTransformQuery(array &$query, string $how)
     * 
     * Transform query different way specified by $how.
     * May return some information about performed transform.
     */
    protected function _performTransformQuery(&$queryMain, $how)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }
    
    
    /**
     * resource _performQuery($arrayQuery)
     * Must return:
     * - For SELECT queries: ID of result-set (PHP resource).
     * - For other  queries: query status (scalar).
     * - For error  queries: null (and call _setLastError()).
     */
    protected function _performQuery($arrayQuery)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }
    
    /**
     * mixed _performFetch($resultResource)
     * Fetch ONE NEXT row from result-set.
     * Must return:
     * - For SELECT queries: all the rows of the query (2d arrray).
     * - For INSERT queries: ID of inserted row.
     * - For UPDATE queries: number of updated rows.
     * - For other  queries: query status (scalar).
     * - For error  queries: null (and call _setLastError()).
     */
	protected function _performFetch($result)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * array _performTotal($arrayQuery)
     */
    protected function _performTotal($arrayQuery)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * mixed _performTransaction($mode)
     * Start new transaction.
     */
    protected function _performTransaction($mode=null)
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }
    
    /**
     * mixed _performCommit()
     * Commit the transaction.
     */
    protected function _performCommit()
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }

    /**
     * mixed _performRollback()
     * Rollback the transaction.
     */
    protected function _performRollback()
    {
        die("Method must be defined in derived class. Abstract function called at ".__FILE__." line ".__LINE__);
    }
    
    /**
     * string _performGetPlaceholderIgnoreRe()
     * Return regular expression which matches ignored query parts.
     * This is needed to skip placeholder replacement inside comments, constants etc.
     */
    protected function _performGetPlaceholderIgnoreRe()
    {
        return '';
    }    
    
    /**
     * Returns marker for native database placeholder. E.g. in FireBird it is '?',
     * in PostgreSQL - '$1', '$2' etc.
     * 
     * @param int $n Number of native placeholder from the beginning of the query (begins from 0!).
     * @return string String representation of native placeholder marker (by default - '?').
     */
    protected function _performGetNativePlaceholderMarker($n)
    {
        return '?';
    }  
      
    
    /**
     * Private methods.
     */
    #function ____________PRIVATE() {} // for phpEclipse outline     


    /**
     * array _query($query, &$total)
     * See _performQuery().
     */
    private function _query($query, &$total)
    {
        $this->_resetLastError();
        
        // Fetch query attributes.
        $this->attributes = $this->_transformQuery($query, 'GET_ATTRIBUTES');

        // Modify query if needed for total counting.
        if ($total) {
            $this->_transformQuery($query, 'CALC_TOTAL');
        }
        $is_cacher_callable = (is_callable($this->_cacher) || (method_exists($this->_cacher, 'get') && method_exists($this->_cacher, 'save')));
        $rows = null;
        $cache_it = false;
        if (!empty($this->attributes['CACHE']) && $is_cacher_callable) {

            $hash = $this->_cachePrefix . md5(serialize($query));
            // Getting data from cache if possible
            $fetchTime = $firstFetchTime = 0;
            $qStart    = $this->_microtime();
            $cacheData = $this->_cache($hash);
            $queryTime = $this->_microtime() - $qStart;

            $storeTime  = isset($cacheData['storeTime'])  ? $cacheData['storeTime']  : null;
            $invalCache = isset($cacheData['invalCache']) ? $cacheData['invalCache'] : null;
            $result     = isset($cacheData['result'])     ? $cacheData['result']     : null; 
            $rows       = isset($cacheData['rows'])       ? $cacheData['rows']       : null; 


            $cache_params = $this->attributes['CACHE'];

            // Calculating cache time to live
            $re = '/
                (
                    ([0-9]+)           #2 - hours
                h)? [ \t]* 
                (
                    ([0-9]+)           #4 - minutes
                m)? [ \t]* 
                (
                    ([0-9]+)           #6 - seconds
                s?)? (,)?
            /sx';
            $m = null;
            preg_match($re, $cache_params, $m);
            $ttl = @$m[6] + @$m[4] * 60 + @$m[2] * 3600;
            // Cutting out time param - now there are just fields for uniqKey or nothing 
            $cache_params = trim(preg_replace($re, '', $cache_params, 1));

            $uniq_key = null;

            // UNIQ_KEY calculation
            if (!empty($cache_params)) {
                $dummy = null;
                // There is no need in query, cos' needle in $this->attributes['CACHE']
                $this->_transformQuery($dummy, 'UNIQ_KEY');
                $uniq_key = call_user_func_array(array(&$this, 'select'), $dummy);
                $uniq_key = md5(serialize($uniq_key));
            }
            // Check TTL?
            $ttl = empty($ttl) ? true : (int)$storeTime > (time() - $ttl);

            // Invalidate cache?
            if ($ttl && $uniq_key == $invalCache) {
                $this->_logQuery($query);
                $this->_logQueryStat($queryTime, $fetchTime, $firstFetchTime, $rows);

            }
            else $cache_it = true;
        } 

        if (null === $rows || true === $cache_it) {
            $this->_logQuery($query);

            // Run the query (counting time).
            $qStart = $this->_microtime();        
            $result = $this->_performQuery($query);
            $fetchTime = $firstFetchTime = 0;

            if (is_resource($result)) {
                $rows = array();
                // Fetch result row by row.
                $fStart = $this->_microtime();
                $row = $this->_performFetch($result);
                $firstFetchTime = $this->_microtime() - $fStart;
                if ($row !== null) {
                    $rows[] = $row;
                    while ($row=$this->_performFetch($result)) {
                        $rows[] = $row;
                    }
                }
                $fetchTime = $this->_microtime() - $fStart;
            } else {
                $rows = $result;
            }
            $queryTime = $this->_microtime() - $qStart;

            // Log query statistics.
            $this->_logQueryStat($queryTime, $fetchTime, $firstFetchTime, $rows);
            
            // Prepare BLOB objects if needed.
            if (is_array($rows) && !empty($this->attributes['BLOB_OBJ'])) {
                $blobFieldNames = $this->_performGetBlobFieldNames($result);
                foreach ($blobFieldNames as $name) {
                    for ($r = count($rows)-1; $r>=0; $r--) {
                        $rows[$r][$name] =& $this->_performNewBlob($rows[$r][$name]);
                    }
                }
            }
    
            // Transform resulting rows.
            $result = $this->_transformResult($rows);

            // Storing data in cache
            if ($cache_it && $is_cacher_callable) {
                $this->_cache(
                    $hash,
                    array(
                        'storeTime'  => time(),
                        'invalCache' => $uniq_key,
                        'result'     => $result,
                        'rows'       => $rows
                    )
                );
            }

        }
        // Count total number of rows if needed.
        if (is_array($result) && $total) {
            $this->_transformQuery($query, 'GET_TOTAL');
            $total = call_user_func_array(array(&$this, 'selectCell'), $query);
        }

        return $result;
    }
    
    
    /**
     * mixed _transformQuery(array &$query, string $how)
     * 
     * Transform query different way specified by $how.
     * May return some information about performed transform.
     */
    private function _transformQuery(&$query, $how)
    {
        // Do overriden transformation.
        $result = $this->_performTransformQuery($query, $how);
        if ($result === true) return $result;
        // Common transformations.
        switch ($how) {
            case 'GET_ATTRIBUTES':
                // Extract query attributes.
                $options = array();
                $q = $query[0];
                $m = null;
                while (preg_match('/^ \s* -- [ \t]+ (\w+): ([^\r\n]+) [\r\n]* /sx', $q, $m)) {
                    $options[$m[1]] = trim($m[2]);
                    $q = substr($q, strlen($m[0]));
                }
                return $options;
            case 'UNIQ_KEY':
                $q = $this->attributes['CACHE'];
                $i = 0;
                $query = "  -- UNIQ_KEY\n";
                while(preg_match('/(\w+)\.\w+/sx', $q, $m)) {
                    if($i > 0)$query .= "\nUNION\n";
                    $query .= 'SELECT MAX('.$m[0].') AS M, COUNT(*) AS C FROM '.$m[1];
                    $q = substr($q, strlen($m[0]));
                    $i++;
                }
                return true;
        }
        // No such transform.
        $this->_setLastError(-1, "No such transform type: $how", $query);
    }
        
        
    /**
     * void _expandPlaceholders(array &$queryAndArgs, bool $useNative=false)
     * Replace placeholders by quoted values.
     * Modify $queryAndArgs.
     */
    protected function _expandPlaceholders(&$queryAndArgs, $useNative=false)
    {
        $cacheCode = null;
        if ($this->_logger) {
            // Serialize is much faster than placeholder expansion. So use caching.
            $cacheCode = md5(serialize($queryAndArgs) . '|' . $useNative . '|' . $this->_identPrefix);
            if (isset($this->_placeholderCache[$cacheCode])) {
                $queryAndArgs = $this->_placeholderCache[$cacheCode];
                return;
            }
        }
        
        if (!is_array($queryAndArgs)) {
            $queryAndArgs = array($queryAndArgs);
        }

        $this->_placeholderNativeArgs = $useNative? array() : null;
        $this->_placeholderArgs = array_reverse($queryAndArgs);

        $query = array_pop($this->_placeholderArgs); // array_pop is faster than array_shift

        // Do all the work.
        $this->_placeholderNoValueFound = false;
        $query = $this->_expandPlaceholdersFlow($query);

        if ($useNative) {
            array_unshift($this->_placeholderNativeArgs, $query);
            $queryAndArgs = $this->_placeholderNativeArgs;
        } else {
            $queryAndArgs = array($query);
        }
        
        if ($cacheCode) {
            $this->_placeholderCache[$cacheCode] = $queryAndArgs;
        }
    }

        
    /**
     * Do real placeholder processing.
     * Imply that all interval variables (_placeholder_*) already prepared.
     * May be called recurrent!
     */
    private function _expandPlaceholdersFlow($query)
    {
        $re = '{
            (?>
                # Ignored chunks.
                (?>
                    # Comment. 
                    -- [^\r\n]* 
                ) 
                  |
                (?> 
                    # DB-specifics.
                    ' . trim($this->_performGetPlaceholderIgnoreRe()) . '
                )
            ) 
              |
            (?> 
                # Optional blocks
                \{
                    # Use "+" here, not "*"! Else nested blocks are not processed well.
                    ( (?> (?>[^{}]+)  |  (?R) )* )             #1
                \}
            )
              |
            (?>
                # Placeholder
                (\?) ( [_dsafn\#]? )                           #2 #3
            )
        }sx';
        $query = preg_replace_callback(
            $re,
            array(&$this, '_expandPlaceholdersCallback'), 
            $query
        );
        return $query;
    }
    

    /**
     * string _expandPlaceholdersCallback(list $m)
     * Internal function to replace placeholders (see preg_replace_callback).
     */
    private function _expandPlaceholdersCallback($m)
    {
        // Placeholder.
        if (!empty($m[2])) {
            $type = $m[3];
            
            // Idenifier prefix.
            if ($type == '_') {
                return $this->_identPrefix;
            }
            
            // Value-based placeholder.
            if (!$this->_placeholderArgs) return 'DBSIMPLE_ERROR_NO_VALUE';
            $value = array_pop($this->_placeholderArgs);

            // Skip this value?
            if ($value === DBSIMPLE_SKIP) {
                $this->_placeholderNoValueFound = true;
                return '';
            }
            
            // First process guaranteed non-native placeholders.
            switch ($type) {
                case 'a':
                    if (!$value) $this->_placeholderNoValueFound = true;
                    if (!is_array($value)) return 'DBSIMPLE_ERROR_VALUE_NOT_ARRAY';
                    $parts = array();
                    foreach ($value as $k=>$v) {
                        $v = $v === null? 'NULL' : $this->escape($v);
                        if (!is_int($k)) {
                            $k = $this->escape($k, true);
                            $parts[] = "$k=$v";
                        } else {
                            $parts[] = $v;
                        }
                    }
                    return join(', ', $parts);
                case "#":
                    // Identifier.
                    if (!is_array($value)) return $this->escape($value, true);
                    $parts = array();
                    foreach ($value as $table => $identifier) {
                        if (!is_string($identifier)) return 'DBSIMPLE_ERROR_ARRAY_VALUE_NOT_STRING';
                        $parts[] = (!is_int($table)? $this->escape($table, true) . '.' : '') . $this->escape($identifier, true);
                    }
                    return join(', ', $parts);
                case 'n':
                    // NULL-based placeholder.
                    return empty($value)? 'NULL' : intval($value);
            }

            // Native arguments are not processed.
            if ($this->_placeholderNativeArgs !== null) {
                $this->_placeholderNativeArgs[] = $value;
                return $this->_performGetNativePlaceholderMarker(count($this->_placeholderNativeArgs) - 1);
            } 
            
            // In non-native mode arguments are quoted.
            if ($value === null) return 'NULL';
            switch ($type) {
                case '':
                    if (!is_scalar($value)) return 'DBSIMPLE_ERROR_VALUE_NOT_SCALAR';
                    return $this->escape($value);
                case 'd': 
                    return intval($value);
                case 'f':
                    return str_replace(',', '.', floatval($value));
            }
            // By default - escape as string.
            return $this->escape($value);
        }
        
        // Optional block.
        if (isset($m[1]) && strlen($block=$m[1])) {
            $prev = @$this->_placeholderNoValueFound;
            $block = $this->_expandPlaceholdersFlow($block);
            $block = $this->_placeholderNoValueFound? '' : ' ' . $block . ' ';
            $this->_placeholderNoValueFound = $prev; // recurrent-safe            
            return $block;
        }
        
        // Default: skipped part of the string.
        return $m[0];
    }
    
    
    /**
     * void _setLastError($code, $msg, $query)
     * Set last database error context.
     * Aditionally expand placeholders.
     */
    public function _setLastError($code, $msg, $query)
    {
        if (is_array($query)) {
            $this->_expandPlaceholders($query, false);
            $query = $query[0];
        }
        return DbSimple_Generic_LastError::_setLastError($code, $msg, $query);
    }
    
    
    /**
     * Return microtime as float value.
     */
    private function _microtime()
    {
        $t = microtime(1);
        return $t;
    }
    
    
    /**
     * Convert SQL field-list to COUNT(...) clause
     * (e.g. 'DISTINCT a AS aa, b AS bb' -> 'COUNT(DISTINCT a, b)').
     */
    private function _fieldList2Count($fields)
    {
        $m = null;
        if (preg_match('/^\s* DISTINCT \s* (.*)/sx', $fields, $m)) {
            $fields = $m[1];
            $fields = preg_replace('/\s+ AS \s+ .*? (?=,|$)/sx', '', $fields);
            return "COUNT(DISTINCT $fields)";
        } else {
            return 'COUNT(*)';
        }
    }


    /**
     * array _transformResult(list $rows)
     * Transform resulting rows to various formats.
     */
    private function _transformResult($rows)
    {
        // Process ARRAY_KEY feature.
        if (is_array($rows) && $rows) {
            // Find ARRAY_KEY* AND PARENT_KEY fields in field list.
            $pk = null;
            $ak = array();
            foreach (current($rows) as $fieldName => $dummy) {
                if (0 == strncasecmp($fieldName, DBSIMPLE_ARRAY_KEY, strlen(DBSIMPLE_ARRAY_KEY))) {
                    $ak[] = $fieldName;
                } else if (0 == strncasecmp($fieldName, DBSIMPLE_PARENT_KEY, strlen(DBSIMPLE_PARENT_KEY))) {
                    $pk = $fieldName;
                }
            }
            natsort($ak); // sort ARRAY_KEY* using natural comparision
            
            if ($ak) {
                // Tree-based array? Fields: ARRAY_KEY, PARENT_KEY
                if ($pk !== null) {
                    return $this->_transformResultToForest($rows, $ak[0], $pk);
                }
                // Key-based array? Fields: ARRAY_KEY.
                return $this->_transformResultToHash($rows, $ak);
            }
        }
        return $rows;
    }


    /**
     * Converts rowset to key-based array.
     * 
     * @param array $rows   Two-dimensional array of resulting rows.
     * @param array $ak     List of ARRAY_KEY* field names.
     * @return array        Transformed array.
     */
    private function _transformResultToHash($rows, $arrayKeys)
    {
        $arrayKeys = (array)$arrayKeys;
        $result = array();
        foreach ($rows as $row) {
            // Iterate over all of ARRAY_KEY* fields and build array dimensions.
            $current =& $result;
            foreach ($arrayKeys as $ak) {
                $key = $row[$ak];
                unset($row[$ak]); // remove ARRAY_KEY* field from result row
                if ($key !== null) {
                    $current =& $current[$key];
                } else {
                    // IF ARRAY_KEY field === null, use array auto-indices.
                    $tmp = array();
                    $current[] =& $tmp;
                    $current =& $tmp;
                    unset($tmp); // we use �tmp, because don't know the value of auto-index
                }
            }
            $current = $row; // save the row in last dimension
        }
        return $result;
    }


    /**
     * Converts rowset to the forest.
     * 
     * @param array $rows       Two-dimensional array of resulting rows.
     * @param string $idName    Name of ID field.
     * @param string $pidName   Name of PARENT_ID field.
     * @return array            Transformed array (tree).
     */
    private function _transformResultToForest($rows, $idName, $pidName)
    {
        $children = array(); // children of each ID
        $ids = array();
        // Collect who are children of whom.
        foreach ($rows as $i=>$r) {
            $row =& $rows[$i];
            $id = $row[$idName];
            if ($id === null) {
                // Rows without an ID are totally invalid and makes the result tree to 
                // be empty (because PARENT_ID = null means "a root of the tree"). So 
                // skip them totally.
                continue;
            }
            $pid = $row[$pidName];
            if ($id == $pid) $pid = null;
            $children[$pid][$id] =& $row;
            if (!isset($children[$id])) $children[$id] = array();
            $row['childNodes'] =& $children[$id];
            $ids[$id] = true;
        }
        // Root elements are elements with non-found PIDs.
        $forest = array();
        foreach ($rows as $i=>$r) {
            $row =& $rows[$i];
            $id = $row[$idName];
            $pid = $row[$pidName];
            if ($pid == $id) $pid = null;
            if (!isset($ids[$pid])) {
                $forest[$row[$idName]] =& $row;
            }
            unset($row[$idName]); 
            unset($row[$pidName]);
        }
        return $forest;
    }


    /**
     * Replaces the last array in a multi-dimensional array $V by its first value.
     * Used for selectCol(), when we need to transform (N+1)d resulting array
     * to Nd array (column).
     */
    private function _shrinkLastArrayDimensionCallback(&$v)
    {
        if (!$v) return;
        reset($v);
        if (!is_array($firstCell = current($v))) {
            $v = $firstCell;
        } else {
            array_walk($v, array(&$this, '_shrinkLastArrayDimensionCallback'));
        }
    }
    

    /**
     * void _logQuery($query, $noTrace=false)
     * Must be called on each query.
     * If $noTrace is true, library caller is not solved (speed improvement).
     */
    public function _logQuery($query, $noTrace=false)
    {
        if (!$this->_logger) return;
        $this->_expandPlaceholders($query, false);
        $args = array();
        $args[] =& $this;
        $args[] = $query[0];
        $args[] = $noTrace? null : $this->findLibraryCaller();
        return call_user_func_array($this->_logger, $args);
    }
    
    
    /**
     * void _logQueryStat($queryTime, $fetchTime, $firstFetchTime, $rows)
     * Log information about performed query statistics.
     */
    private function _logQueryStat($queryTime, $fetchTime, $firstFetchTime, $rows)
    {
        // Always increment counters.
        $this->_statistics['time'] += $queryTime;
        $this->_statistics['count']++;
        
        // If no logger, economize CPU resources and actually log nothing.
        if (!$this->_logger) return;
        
        $dt = round($queryTime * 1000);
        $firstFetchTime = round($firstFetchTime*1000);
        $tailFetchTime = round($fetchTime * 1000) - $firstFetchTime;
        $log = "  -- ";
        if ($firstFetchTime + $tailFetchTime) {
            $log = sprintf("  -- %d ms = %d+%d".($tailFetchTime? "+%d" : ""), $dt, $dt-$firstFetchTime-$tailFetchTime, $firstFetchTime, $tailFetchTime);
        } else {
            $log = sprintf("  -- %d ms", $dt);
        }
        $log .= "; returned ";

        if (!is_array($rows)) {
            $log .= $this->escape($rows); 
        } else {
            $detailed = null;
            if (count($rows) == 1) {
                $len = 0;
                $values = array();
                foreach ($rows[0] as $k=>$v) {
                    $len += strlen($v);
                    if ($len > $this->MAX_LOG_ROW_LEN) {
                        break;
                    }
                    $values[] = $v === null? 'NULL' : $this->escape($v);
                }
                if ($len <= $this->MAX_LOG_ROW_LEN) {
                    $detailed = "(" . preg_replace("/\r?\n/", "\\n", join(', ', $values)) . ")";
                }
            }
            if ($detailed) {
                $log .= $detailed;
            } else {
                $log .= count($rows). " row(s)";
            }
        }
        
        $this->_logQuery($log, true);
    }
    
    /**
     * mixed _cache($hash, $result=null)
     * Calls cache mechanism if possible.
     */
    private function _cache($hash, $result=null)
    {
        if (is_callable($this->_cacher)) {
            return call_user_func($this->_cacher, $hash, $result);
        } else if (is_object($this->_cacher) && method_exists($this->_cacher, 'get') && method_exists($this->_cacher, 'save')) {
            if (null === $result)
                return $this->_cacher->get($hash);
            else
                $this->_cacher->save($result, $hash);
        }
        else return false;
    }
    
    
    /**
     * protected constructor(string $dsn)
     * 
     * Prevent from direct creation of this object.
     */
    protected function DbSimple_Generic_Database()
    {
        die("This is protected constructor! Do not instantiate directly at ".__FILE__." line ".__LINE__);
    }
    
    // Identifiers prefix (used for ?_ placeholder).
    var $_identPrefix = '';

    // Queries statistics.
    var $_statistics = array(
        'time'  => 0,
        'count' => 0,
    );
    
    var $_cachePrefix = '';

    var $_logger = null;
    var $_cacher = null;
    var $_placeholderArgs, $_placeholderNativeArgs, $_placeholderCache=array();
    var $_placeholderNoValueFound;
    
    /**
     * When string representation of row (in characters) is greater than this,
     * row data will not be logged.
    */
    var $MAX_LOG_ROW_LEN = 128;
}
?>